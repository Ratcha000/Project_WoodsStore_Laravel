<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    
    public function create()
    {
        return view('customers.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'Customer_name' => 'required|string|max:255',
            'Customer_email' => 'required|email|unique:customers,Customer_email',
            'Customer_phone' => 'nullable|string|max:20',
            'Customer_address' => 'nullable|string',
            'Customer_type' => 'required|in:regular,wholesale,vip',
            'Status' => 'required|in:active,inactive,banned',
        ]);

        Customer::create($request->all());

        return redirect()->route('customers.create')->with('success', 'เพิ่มข้อมูลลูกค้าเรียบร้อยแล้ว');
    }
}
