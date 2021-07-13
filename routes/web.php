<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\EnsureCartIsNotEmpty;
use Illuminate\Support\Facades\Route;


Route::redirect('/', 'products');

Route::middleware('auth')
    ->prefix('cart')
    ->name('cart.')
    ->group(function () {
        Route::get('/', [CartController::class, 'index'])
            ->name('index');

        Route::post('{product}', [CartController::class, 'store'])
            ->name('store');

        Route::delete('{cart}', [CartController::class, 'destroy'])
            ->name('destroy');
    });

Route::middleware('auth')
    ->group(function () {
        Route::resource('orders', OrderController::class)
            ->middleware(EnsureCartIsNotEmpty::class)
            ->only('create', 'store');

        Route::resource('orders', OrderController::class)
            ->only('show');
    });

Route::resource('products', ProductController::class)
    ->only('index', 'show');

Route::resource('categories', CategoryController::class)
    ->only('show');
