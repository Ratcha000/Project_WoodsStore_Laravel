<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use App\Models\CustomOrder;

class ProductController extends Controller
{
    
    public function index()
    {
       
        $rawWood = Product::whereNotNull('SID')
            ->select('PID', 'P_Name', 'Price', 'P_Width', 'P_Height', 'P_Thickness', 'P_Quantity')
            ->get();

        
        $storeProducts = Product::whereNotNull('Cusor_ID')
            ->where('Cusor_ID', 1)
            ->select('PID', 'P_Name', 'Price', 'P_Width', 'P_Height', 'P_Thickness', 'P_Quantity')
            ->get();

       
        $customOrders = Product::whereNotNull('Cusor_ID')
            ->where('Cusor_ID', '!=', 1)
            ->select('PID', 'P_Name', 'Price', 'P_Width', 'P_Height', 'P_Thickness', 'P_Quantity')
            ->get();

        return view('products.index', compact('rawWood', 'storeProducts', 'customOrders'));
    }
  



    
    public function showAddStockToProduct()
    {
        $stocks = Stock::where('Stock_quantity', '>', 0)->get();
        return view('products.add_from_stock', compact('stocks'));
    }

   
    public function addStockToProduct(Request $request, $SID)
    {
        $stock = Stock::findOrFail($SID);

        
        if ($request->P_Quantity > $stock->Stock_quantity) {
            return redirect()->back()->with('error', 'จำนวนไม้ดิบในสต็อกไม่เพียงพอ');
        }

        
        $stock->Stock_quantity -= $request->P_Quantity;
        $stock->save();

        
        Product::create([
            'SID' => $stock->SID,
            'Cusor_ID' => NULL,
            'P_Name' => $stock->S_Name,
            'Price' => $request->Price,
            'P_Width' => $stock->S_Width,
            'P_Height' => $stock->S_Height,
            'P_Thickness' => $stock->S_Thickness,
            'P_Quantity' => $request->P_Quantity,
            'P_Status' => 'Available',
        ]);

        return redirect()->back()->with('success', 'เพิ่มไม้ดิบไปขายเรียบร้อย');
    }

    
    public function addCompletedOrdersToProducts()
    {
        
        $completedOrders = CustomOrder::where('Cus_Status', 'Completed')->get();
    
        if ($completedOrders->isEmpty()) {
            return redirect()->back()->with('error', 'ไม่มีคำสั่งผลิตที่เสร็จสิ้น');
        }
    
        foreach ($completedOrders as $order) {
            Product::create([
                'SID' => NULL, 
                'Cusor_ID' => $order->Cusor_ID,
                'P_Name' => $order->Product_Name,
                'Price' => $order->Cus_Price,
                'P_Width' => $order->Cus_Width,
                'P_Height' => $order->Cus_Height,
                'P_Thickness' => $order->Cus_Thickness,
                'P_Quantity' => $order->Cus_Quantity,
                'P_Status' => 'Available',
            ]);
    
            
            $order->update(['Cus_Status' => 'Archived']);
        }
    
        return redirect()->back()->with('success', 'เพิ่มสินค้าแปรรูปไปยังคลังสินค้าเรียบร้อยแล้ว');
    }
    
}


