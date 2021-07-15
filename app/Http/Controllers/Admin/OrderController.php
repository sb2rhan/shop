<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderApproved;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::query()
            ->with('user')
            ->latest()
            ->paginate();

        return view('admin.orders.index', [
            'orders' => $orders
        ]);
    }

    public function show(Order $order)
    {
        return redirect()->route('orders.show', $order);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index');
    }

    function approve(Order $order) {
        $order->update([
            'is_approved' => true
        ]);

        $order->user->notify(new OrderApproved($order));

        return back();
    }
}
