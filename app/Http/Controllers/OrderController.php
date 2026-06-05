<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Riwayat pesanan user
     */
    public function index()
    {
        $orders = Order::with('items')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('frontend.orders.index', compact('orders'));
    }

    /**
     * Detail pesanan user
     */
    public function show(Order $order)
    {
        // Pastikan hanya pemilik yang bisa lihat
        abort_if($order->user_id !== auth()->id(), 403);

        $order->load('items.product');

        return view('frontend.orders.show', compact('order'));
    }
}
