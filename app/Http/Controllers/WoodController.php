<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wood;
class WoodController extends Controller
{
    //
    public function create()
    {
        return view('woods.create');
    }

    // บันทึกข้อมูลไม้ลงในฐานข้อมูล
    public function store(Request $request)
    {
        $request->validate([
            'WType' => 'required|string|max:255',
            'WPattern' => 'required|string|max:255',
            'W_Price' => 'required|numeric|min:0',
        ]);

        Wood::create([
            'WType' => $request->WType,
            'WPattern' => $request->WPattern,
            'W_Price' => $request->W_Price,
        ]);

        return redirect()->route('woods.create')->with('success', 'เพิ่มข้อมูลไม้เรียบร้อยแล้ว');
    }
}
