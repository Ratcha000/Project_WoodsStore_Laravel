<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Wood;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function create()
    {
        
        $woods = Wood::all();
        return view('Stork_insert', compact('woods'));
    }

    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'WID' => 'required|exists:woods,WID',
            'S_Name' => 'required|string|max:255',
            'S_Width' => 'required|numeric',
            'S_Height' => 'required|numeric',
            'S_Thickness' => 'required|numeric',
            'Stock_quantity' => 'required|integer',
            'S_Status' => 'nullable|string|max:255',
        ]);

       
        Stock::create([
            'WID' => $request->WID,
            'S_Name' => $request->S_Name,
            'S_Width' => $request->S_Width,
            'S_Height' => $request->S_Height,
            'S_Thickness' => $request->S_Thickness,
            'Stock_quantity' => $request->Stock_quantity,
            'S_Status' => $request->S_Status,
        ]);

        
        return redirect()->route('stock.create')->with('success', 'Stock added successfully!');
    }

    public function view()
    {
        $stocks = Stock::with('wood')->get(); 
        return view('Stork_view', compact('stocks'));
    }
}
