<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartPromocodeRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Promocode;

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

    function applyPromocode(CartPromocodeRequest $request) {
        if (session()->has('discount'))
            abort(403);

        $promocode = Promocode::query()
            ->where('code', $request->code)
            ->first();

        session()->put('discount', $promocode->discount / 100);
        return back();
    }
}
