<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    function index() {
        $cart = auth()->user()
            ->cart()
            ->latest()
            ->get();

        $sum = 0;
        $cart->each(function (Cart $cart) use(&$sum) {
            $sum += $cart->product->calculate($cart->amount);
        });

        return view('pages.cart.index', [
            'cart' => $cart,
            'total' => $sum
        ]);
    }

    function store(Product $product) {
        /** @var Cart $cart */
        $cart = auth()->user()
            ->cart()
            ->firstOrCreate([
                $product->getForeignKey() => $product->id
            ]);

        $cart->increment('amount');

        return redirect()->route('cart.index');
    }

    function destroy(Cart $cart) {
        $cart->delete();
        return back();
    }
}
