<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    function index() {
        $products = Product::query()
            ->latest()->paginate();

        return view('pages.products.index', [
            'products' => $products
        ]);
    }

    function show(Product $product) {
        return view('pages.products.show', [
            'product' => $product
        ]);
    }
}
