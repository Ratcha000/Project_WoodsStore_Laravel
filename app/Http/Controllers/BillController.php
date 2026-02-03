<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Order;
use Barryvdh\DomPDF\PDF;


class BillController extends Controller
{
    //
    public function createBill($order_id)
    {
        $order = Order::with('orderDetails')->findOrFail($order_id);

        $totalPrice = $order->orderDetails->sum(fn($item) => $item->Quantity * $item->Price);
        $vat = $totalPrice * 0.07;
        $grandTotal = $totalPrice + $vat;

        $bill = Bill::create([
            'Order_ID' => $order_id,
            'Customer_id' => $order->Customer_id,
            'Total_price' => $totalPrice,
            'VAT' => $vat,
            'Grand_total' => $grandTotal,
            'Payment_status' => 'pending',
        ]);

        foreach ($order->orderDetails as $item) {
            BillDetail::create([
                'Bill_ID' => $bill->Bill_ID,
                'PID' => $item->PID,
                'Quantity' => $item->Quantity,
                'Price' => $item->Price,
                'Total_price' => $item->Quantity * $item->Price,
            ]);
        }

        return redirect()->route('bill.view', $bill->Bill_ID)->with('success', 'สร้างบิลสำเร็จ!');
    }

    public function viewBill($bill_id)
    {
        $bill = Bill::with(['details.product', 'customer'])->findOrFail($bill_id);
        return view('bill.view', compact('bill'));
    }

    public function downloadBillPDF($bill_id)
{
    $bill = Bill::with(['details.product', 'customer'])->findOrFail($bill_id);
    $downloadTime = now()->format('Y-m-d H:i:s'); // ✅ เอาเวลาปัจจุบันตอนที่กดดาวน์โหลด

    $pdf = app(\Barryvdh\DomPDF\PDF::class)->loadView('bill.pdf', compact('bill', 'downloadTime'));

    return $pdf->download('Bill-' . $bill->Bill_ID . '.pdf');
}

public function store(Request $request)
    {
        $bill = Bill::create($request->all());

        // ตรวจสอบว่ามีข้อมูลในบัญชีหรือยัง
        Account::updateOrCreate(
            ['Bill_ID' => $bill->Bill_ID],
            [
                'income' => $bill->Total_price,
                'expense' => null,
                'Ac_date' => now(),
            ]
        );

        return redirect()->route('account.index')->with('success', 'เพิ่มบิลเรียบร้อย');
    }
    
    
}
