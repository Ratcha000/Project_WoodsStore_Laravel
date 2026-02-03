<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomOrder;
use App\Models\Stock;
use App\Models\Customer; // ✅ แก้จาก Customers เป็น Customer
use App\Models\Carpenter;
use App\Models\Wood;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CustomOrderController extends Controller
{
    // แสดงฟอร์มสั่งผลิต
    public function create()
    {
        $stocks = Stock::where('Stock_quantity', '>', 0)->get();
        $customers = Customer::all(); // ✅ แก้จาก Customers เป็น Customer
        $carpenters = Carpenter::all();
        $woods = Wood::all();

        return view('custom_orders.create', compact('stocks', 'customers', 'carpenters', 'woods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Customer_id' => 'required|exists:customers,Customer_id',
            'Product_Name' => 'required|string|max:255',
            'Cus_Width' => 'required|numeric|min:0',
            'Cus_Height' => 'required|numeric|min:0',
            'Cus_Thickness' => 'required|numeric|min:0',
            'Cus_Quantity' => 'required|integer|min:1',
            'Stock_ID' => 'required|exists:stocks,SID',
            'Used_Stock_Quantity' => 'required|integer|min:1', // ✅ ตรวจสอบจำนวนไม้ที่ใช้
            'SSN_Passport' => 'required|exists:carpenters,SSN_Passport',
            'Cus_Price' => 'required|numeric|min:0',
        ]);
    
        DB::transaction(function () use ($request) {
            $stock = Stock::findOrFail($request->Stock_ID);
    
            if ($stock->Stock_quantity < $request->Used_Stock_Quantity) {
                return back()->withErrors(['Stock_ID' => 'Stock quantity is insufficient.']);
            }
    
            // ลดจำนวน Stock ตามจำนวนที่ใช้
            $stock->Stock_quantity -= $request->Used_Stock_Quantity;
            $stock->save();
    
            // บันทึกข้อมูล Custom Order
            CustomOrder::create([
                'Customer_id' => $request->Customer_id,
                'Product_Name' => $request->Product_Name,
                'Cus_Width' => $request->Cus_Width,
                'Cus_Height' => $request->Cus_Height,
                'Cus_Thickness' => $request->Cus_Thickness,
                'Cus_Design' => $request->Cus_Design,
                'Cus_Price' => $request->Cus_Price,
                'Cus_Quantity' => $request->Cus_Quantity,
                'Used_Stock_Quantity' => $request->Used_Stock_Quantity, // ✅ เพิ่มฟิลด์นี้
                'Stock_ID' => $request->Stock_ID,
                'SSN_Passport' => $request->SSN_Passport,
                'Cus_Status' => 'Pending',
            ]);
        });
    
        return redirect()->route('custom_orders.index')->with('success', 'Custom Order created successfully.');
    }

    // แสดงรายการคำสั่งผลิต
    public function index()
    {
        $customOrders = CustomOrder::with(['customer', 'stock', 'carpenter'])->get(); // ✅ เปลี่ยน Customers เป็น customer
        return view('custom_orders.index', compact('customOrders'));
    }

    // แสดงฟอร์มแก้ไข
    public function edit($id)
    {
        $customOrder = CustomOrder::findOrFail($id);
        $stocks = Stock::where('Stock_quantity', '>', 0)->get();
        $customers = Customer::all(); // ✅ แก้จาก Customers เป็น Customer
        $carpenters = Carpenter::all();
        $woods = Wood::all();

        return view('custom_orders.edit', compact('customOrder', 'stocks', 'customers', 'carpenters', 'woods'));
    }

    // อัปเดตข้อมูลคำสั่งผลิต
    public function update(Request $request, $id)
    {
        $customOrder = CustomOrder::findOrFail($id);
        $customOrder->update($request->all());

        return redirect()->route('custom_orders.index')->with('success', 'Custom Order updated successfully.');
    }

    
    public function addToProduct($id)
    {
        $customOrder = CustomOrder::findOrFail($id);

        if ($customOrder->Cus_Status !== 'Completed') {
            return redirect()->back()->with('error', 'สินค้ายังไม่พร้อมขาย');
        }

        Product::create([
            'SID' => NULL,
            'Cusor_ID' => $customOrder->Cusor_ID,
            'P_Name' => $customOrder->Product_Name,
            'Price' => $customOrder->Cus_Price,
            'P_Width' => $customOrder->Cus_Width,
            'P_Height' => $customOrder->Cus_Height,
            'P_Thickness' => $customOrder->Cus_Thickness,
            'P_Quantity' => $customOrder->Cus_Quantity,
            'P_Status' => 'Available',
        ]);

       
        $customOrder->update(['Cus_Status' => 'Archived']);

        return redirect()->route('custom_orders.index')->with('success', 'เพิ่มสินค้าไปยังคลังสินค้าเรียบร้อยแล้ว');
    }
    
}
