<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cost;
use App\Models\Carpenter;
use App\Models\Wood;

class CostController extends Controller
{
    //
     // แสดงรายการค่าใช้จ่ายทั้งหมด
     public function index()
     {
         $costs = Cost::with(['carpenter', 'wood'])->get();
         return view('costs.index', compact('costs'));
     }
 
     // แสดงฟอร์มสร้างค่าใช้จ่ายใหม่
     public function create()
     {
         $carpenters = Carpenter::all();
         $woods = Wood::all();
         return view('costs.create', compact('carpenters', 'woods'));
     }
 
     // บันทึกข้อมูลค่าใช้จ่าย
     public function store(Request $request)
     {
         $request->validate([
             'Cost_Type' => 'required',
             'Expense_Date' => 'required|date',
             'Total_Cost' => 'required|numeric',
         ]);
 
         Cost::create($request->all());
 
         return redirect()->route('costs.index')->with('success', 'บันทึกค่าใช้จ่ายเรียบร้อยแล้ว');
     }
 
     // แสดงฟอร์มแก้ไขค่าใช้จ่าย
     public function edit($id)
     {
         $cost = Cost::findOrFail($id);
         $carpenters = Carpenter::all();
         $woods = Wood::all();
         return view('costs.edit', compact('cost', 'carpenters', 'woods'));
     }
 
     // อัปเดตข้อมูลค่าใช้จ่าย
     public function update(Request $request, $id)
     {
         $request->validate([
             'Cost_Type' => 'required',
             'Expense_Date' => 'required|date',
             'Total_Cost' => 'required|numeric',
         ]);
 
         $cost = Cost::findOrFail($id);
         $cost->update($request->all());
 
         return redirect()->route('costs.index')->with('success', 'อัปเดตค่าใช้จ่ายเรียบร้อยแล้ว');
     }
 
     // ลบค่าใช้จ่าย
     public function destroy($id)
     {
         Cost::findOrFail($id)->delete();
         return redirect()->route('costs.index')->with('success', 'ลบค่าใช้จ่ายเรียบร้อยแล้ว');
     }

     public function storeCost(Request $request)
     {
         $cost = Cost::create($request->all());
 
         // ตรวจสอบว่ามีข้อมูลในบัญชีหรือยัง
         Account::updateOrCreate(
             ['Cost_ID' => $cost->Cost_ID],
             [
                 'income' => null,
                 'expense' => $cost->Total_Cost,
                 'Ac_date' => $cost->Expense_Date,
             ]
         );
 
         return redirect()->route('account.index')->with('success', 'เพิ่มค่าใช้จ่ายเรียบร้อย');
     }
}
