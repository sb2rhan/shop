<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    function show(Category $category) {
        $products = Product::query()
            ->where($category->getForeignKey(), $category->id)
            ->latest()->paginate();

        return view('pages.products.index', [
            'products' => $products
        ]);
    }
}
