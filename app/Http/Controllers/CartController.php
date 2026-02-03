<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Delivery;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function showCart() {
        $cart = Session::get('cart', []);
        return view('cart.index', compact('cart'));
    }
    

    // ✅ เพิ่มสินค้าไปยังตะกร้า
    public function addToCart(Request $request)
    {
        $request->validate([
            'PID' => 'required|exists:products,PID',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->PID);
        $cart = Session::get('cart', []);

        if (isset($cart[$product->PID])) {
            $cart[$product->PID]['quantity'] += $request->quantity;
        } else {
            $cart[$product->PID] = [
                'name' => $product->P_Name,
                'size' => "{$product->P_Width}x{$product->P_Height}x{$product->P_Thickness}",
                'price' => $product->Price,
                'quantity' => $request->quantity,
            ];
        }

        Session::put('cart', $cart);
        return redirect()->route('cart.show')->with('success', 'เพิ่มสินค้าในตะกร้าเรียบร้อย');
    }

    // ✅ ลบสินค้าออกจากตะกร้า
    public function removeFromCart(Request $request)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$request->PID])) {
            unset($cart[$request->PID]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.show')->with('success', 'ลบสินค้าออกจากตะกร้าเรียบร้อย');
    }
}
