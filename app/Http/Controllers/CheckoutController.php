<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class CheckoutController extends Controller
{
    public function index() {
        if (Cart::getTotalQuantity() < 10) {
            return redirect()->back()->with('info', 'Minimal order 10!');
        }

        $carts  = Cart::getContent();
        $weight = 0;

        foreach ($carts as $cart) {
            $weight += $cart->attributes['weight'] * $cart->quantity;
        }

        return view('pages.admin.checkout.index', compact('weight'));
    }
}
