<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;
use Carbon\Carbon;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\Order;

class ShowController extends Controller
{
    public function showDeliveries()
    {
        // ดึงข้อมูลทั้งหมดจากตาราง deliveries และรวมกับข้อมูลลูกค้าและคำสั่งซื้อ
        $deliveries = Delivery::with(['order', 'customer'])->orderBy('Delivery_date', 'desc')->get();

        return view('show.deliveries', compact('deliveries'));
    }

    public function updateDeliveryStatus(Request $request, $id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->Delivery_status = $request->Delivery_status;

        // ถ้าสถานะเป็น "shipped" ให้บันทึกวันที่ปัจจุบันลงใน Delivery_date
        if ($request->Delivery_status == 'shipped') {
            $delivery->Delivery_date = Carbon::now();
        } else {
            $delivery->Delivery_date = null; // รีเซ็ตวันที่ ถ้าเปลี่ยนสถานะกลับ
        }

        $delivery->save();

        return redirect()->route('deliveries.show')->with('success', 'อัปเดตสถานะการจัดส่งเรียบร้อย!');
    }



    public function showBills()
    {
        // ดึงข้อมูลทั้งหมดจากตาราง bills และรวมกับข้อมูลลูกค้าและคำสั่งซื้อ
        $bills = Bill::with(['order', 'customer'])->orderBy('created_at', 'desc')->get();

        return view('show.bills', compact('bills'));
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $bill = Bill::findOrFail($id);
        $bill->Payment_status = $request->Payment_status;
        $bill->save();

        return redirect()->route('bills.show')->with('success', 'อัปเดตสถานะการชำระเงินเรียบร้อย!');
    }



    public function showCustomers()
    {
        // ดึงข้อมูลลูกค้าทั้งหมด
        $customers = Customer::orderBy('created_at', 'desc')->get();

        return view('show.customers', compact('customers'));
    }

    public function updateCustomer(Request $request, $id) // ✅ ฟังก์ชันชื่อ updateCustomer
    {
        $customer = Customer::findOrFail($id);
        $customer->Status = $request->Status;
        $customer->Customer_type = $request->Customer_type;
        $customer->save();

        return redirect()->route('customers.show')->with('success', 'อัปเดตข้อมูลลูกค้าเรียบร้อย!');
    }


    public function showOrders()
    {
        // ดึงข้อมูลคำสั่งซื้อทั้งหมด
        $orders = Order::with('customer')->orderBy('Order_date', 'desc')->get();

        return view('show.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->Status = $request->Status;
        $order->save();

        return redirect()->route('orders.show')->with('success', 'อัปเดตสถานะคำสั่งซื้อเรียบร้อย!');
    }
}

    
