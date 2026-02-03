<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Delivery;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Bill;  // ✅ เพิ่มการเรียกใช้ Bill
use App\Models\BillDetail;  // ✅ เพิ่มการเรียกใช้ BillDetail
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller

{

public function orderSummary(Request $request)
{
    $cartData = json_decode($request->cart_data, true);

    if (!$cartData || count($cartData) == 0) {
        return redirect()->back()->with('error', '❌ ตะกร้าสินค้าของคุณว่างเปล่า!');
    }

    // ดึงรายชื่อลูกค้าจากฐานข้อมูล
    $customers = Customer::all();

    return view('order_summary', compact('cartData', 'customers'));
}

public function confirmOrder(Request $request)
{
    \Log::info('📥 ข้อมูลที่รับจากฟอร์ม:', $request->all());

    if (!$request->has('customer_id') || !$request->has('cart_data')) {
        return redirect()->back()->with('error', '❌ ข้อมูลคำสั่งซื้อไม่ครบถ้วน');
    }

    $cartData = json_decode($request->cart_data, true);
    $customerId = $request->customer_id;

    DB::beginTransaction();

    try {
        // ✅ สร้าง Order
        $order = Order::create([
            'Customer_id' => $customerId,
            'Order_date' => now(),
            'Total_price' => 0,
            'Status' => 'pending',
        ]);

        $totalPrice = 0;

        foreach ($cartData as $item) {
            if (!isset($item['id'])) {
                return redirect()->back()->with('error', '❌ ข้อมูลสินค้าไม่ถูกต้อง (ไม่มี ID)');
            }

            // ✅ เพิ่มสินค้าลงใน OrderDetail
            OrderDetail::create([
                'Order_ID' => $order->Order_ID,
                'PID' => $item['id'],
                'Quantity' => $item['quantity'],
                'Price' => $item['price'],
            ]);

            // ✅ หักสต็อกสินค้า
            Product::where('PID', $item['id'])->decrement('P_Quantity', $item['quantity']);

            $totalPrice += $item['quantity'] * $item['price'];
        }

        // ✅ สร้างข้อมูลขนส่ง
        Delivery::create([
            'Order_ID' => $order->Order_ID,
            'Customer_id' => $customerId,
            'D_type' => $request->delivery_type,
            'D_price' => $request->delivery_cost ?? 0,
            'distance_km' => $request->distance_km ?? 0,
            'extra_cost' => $request->extra_cost ?? 0,
            'Delivery_status' => 'pending',
        ]);

        // ✅ อัปเดตราคารวมของ Order
        $order->update(['Total_price' => $totalPrice + ($request->delivery_cost ?? 0)]);

        // ✅ คำนวณ VAT และราคารวมสุทธิ
        $vat = $totalPrice * 0.07;
        $grandTotal = $totalPrice + $vat + ($request->delivery_cost ?? 0);

        // ✅ สร้าง Bill
        $bill = Bill::create([
            'Order_ID' => $order->Order_ID,
            'Customer_id' => $customerId,
            'Total_price' => $totalPrice,
            'VAT' => $vat,
            'Grand_total' => $grandTotal,
            'Payment_status' => 'pending',
        ]);

        // ✅ เพิ่มสินค้าใน BillDetail
        foreach ($cartData as $item) {
            BillDetail::create([
                'Bill_ID' => $bill->Bill_ID,
                'PID' => $item['id'],
                'Quantity' => $item['quantity'],
                'Price' => $item['price'],
                'Total_price' => $item['quantity'] * $item['price'],
            ]);
        }

        DB::commit();

        // ✅ ตรวจสอบค่าของ `$bill->Bill_ID`
        \Log::info('✅ บิลถูกสร้าง: Bill_ID = ' . $bill->Bill_ID);

        // ✅ Redirect ไปหน้า order_success พร้อม `bill_id`
        return redirect()->route('order.success', ['bill_id' => $bill->Bill_ID])
                         ->with('success', '✅ คำสั่งซื้อถูกบันทึกแล้ว!');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', '❌ เกิดข้อผิดพลาด: ' . $e->getMessage());
    }
}


//return redirect()->route('order.success', ['bill_id' => $bill->Bill_ID])->with('success', '✅ คำสั่งซื้อถูกบันทึกแล้ว!');



    public function orderSuccess()
    {
        return view('order_success');
    }
}
