<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.admin.home');
    }

    public function detail($slug) {
        $product    = Product::where('slug', $slug)->first();

        return view('pages.admin.product.detail', compact('product'));
    }

    public function store(Request $request, $slug) {
        $product    = Product::where('slug', $slug)->first();

        $cart       = Cart::get($product->id);
        $price      = $product->price_a;
        $quantity   = $request->quantity;

        if ($cart) {
            $quantity   = $cart->quantity + $request->quantity;
        }

        if ($quantity >= 1000) {
            $price  = $product->price_c;
        } elseif ($quantity >= 100 && $quantity < 1000) {
            $price  = $product->price_b;
        }

        Cart::add([
            'id'            => $product->id,
            'name'          => $product->title,
            'price'         => $price,
            'quantity'      => $request->quantity,
            'attributes'    => [
                'weight'    => $product->weight
            ]
        ]);

        return redirect()->back()->with('success', 'Item added to cart');
    }
}
