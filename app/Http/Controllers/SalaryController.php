<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;

class SalaryController extends Controller
{
    
    public function create()
    {
        return view('salaries.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'S_Type' => 'required|string|max:255',
            'S_Pay' => 'required|numeric|min:0',
            'S_Status' => 'required|in:Paid,Unpaid',
        ]);

        Salary::create([
            'S_Type' => $request->S_Type,
            'S_Pay' => $request->S_Pay,
            'S_Status' => $request->S_Status,
        ]);

        return redirect()->route('salaries.create')->with('success', 'เพิ่มข้อมูลเงินเดือนเรียบร้อยแล้ว');
    }
}
