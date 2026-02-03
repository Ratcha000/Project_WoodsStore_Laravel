<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carpenter;
use App\Models\Salary;

class CarpenterController extends Controller
{
    // แสดงฟอร์มกรอกข้อมูลช่างไม้
    public function create()
    {
        $salaries = Salary::all(); // ดึงรายการเงินเดือนเพื่อให้เลือก
        return view('carpenters.create', compact('salaries'));
    }

    // บันทึกข้อมูลช่างไม้ลงในฐานข้อมูล
    public function store(Request $request)
    {
        $request->validate([
            'Fname' => 'required|string|max:255',
            'Lname' => 'required|string|max:255',
            'Tel' => 'nullable|string|max:20',
            'Age' => 'nullable|integer|min:18|max:100',
            'Address' => 'nullable|string',
            'Salary_Type' => 'nullable|string|max:255',
            'Salary_Amount' => 'nullable|numeric|min:0',
            'Payment_Method' => 'nullable|string|max:255',
            'Bonus' => 'nullable|numeric|min:0',
            'Benefits' => 'nullable|string',
            'SID' => 'nullable|exists:salaries,SID', // ตรวจสอบว่า SID ต้องมีอยู่ในตาราง salaries
        ]);

        Carpenter::create($request->all());

        return redirect()->route('carpenters.create')->with('success', 'เพิ่มข้อมูลช่างไม้เรียบร้อยแล้ว');
    }
}
