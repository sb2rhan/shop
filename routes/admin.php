<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromocodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', DashboardController::class)
    ->name('dashboard');

Route::resource('categories', CategoryController::class);

Route::resource('products', ProductController::class);

Route::resource('orders', OrderController::class)
    ->only('index', 'show', 'destroy');

Route::put('orders/{order}/approve', [OrderController::class, 'approve'])
    ->middleware('auth')
    ->name('orders.approve');

Route::resource('promocodes', PromocodeController::class)
    ->except('show');
