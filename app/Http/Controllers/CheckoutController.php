<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Halaman form checkout
     */
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $shipping = 15000; // flat rate
        $total    = $subtotal + $shipping;

        return view('frontend.checkout.index', compact('cart', 'subtotal', 'shipping', 'total'));
    }

    /**
     * Proses checkout — simpan order, kurangi stok, kosongkan cart
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string',
            'payment_method' => 'required|in:transfer,cod',
            'notes'          => 'nullable|string|max:500',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda kosong.');
        }

        // Validasi stok sebelum simpan
        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            if (!$product || $product->stock < $item['qty']) {
                return back()->with('error', 'Stok "' . $item['name'] . '" tidak mencukupi. Silakan ubah keranjang.');
            }
        }

        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);
        $shipping = 15000;
        $total    = $subtotal + $shipping;

        DB::transaction(function () use ($request, $cart, $subtotal, $shipping, $total) {
            $order = Order::create([
                'user_id'        => auth()->id(),
                'order_code'     => 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
                'name'           => $request->name,
                'phone'          => $request->phone,
                'address'        => $request->address,
                'notes'          => $request->notes,
                'subtotal'       => $subtotal,
                'shipping_cost'  => $shipping,
                'total'          => $total,
                'payment_method' => $request->payment_method,
                'status'         => 'pending',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item['product_id'],
                    'product_name' => $item['name'],
                    'price'        => $item['price'],
                    'qty'          => $item['qty'],
                    'subtotal'     => $item['price'] * $item['qty'],
                ]);

                // Kurangi stok
                Product::where('id', $item['product_id'])->decrement('stock', $item['qty']);
            }

            // Kosongkan keranjang
            session()->forget('cart');

            // Simpan order_id ke session untuk halaman sukses
            session()->put('last_order_id', $order->id);
        });

        return redirect()->route('checkout.success');
    }

    /**
     * Halaman sukses setelah checkout
     */
    public function success()
    {
        $orderId = session()->pull('last_order_id');

        if (!$orderId) {
            return redirect()->route('shop.index');
        }

        $order = Order::with('items.product')->findOrFail($orderId);

        return view('frontend.checkout.success', compact('order'));
    }
}
