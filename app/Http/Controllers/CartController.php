<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Tampilkan halaman keranjang
     */
    public function index()
    {
        $cart  = session()->get('cart', []);
        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);

        return view('frontend.cart.index', compact('cart', 'total'));
    }

    /**
     * Tambah produk ke keranjang
     */
    public function add(Request $request, Product $product)
    {
        $request->validate(['qty' => 'required|integer|min:1']);

        if ($product->stock < $request->qty) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $cart = session()->get('cart', []);
        $key  = $product->id;

        if (isset($cart[$key])) {
            $newQty = $cart[$key]['qty'] + $request->qty;
            if ($newQty > $product->stock) {
                return back()->with('error', 'Jumlah melebihi stok tersedia (' . $product->stock . ').');
            }
            $cart[$key]['qty'] = $newQty;
        } else {
            $cart[$key] = [
                'product_id' => $product->id,
                'name'       => $product->name,
                'price'      => $product->price,
                'qty'        => $request->qty,
                'image'      => $product->image,
                'stock'      => $product->stock,
                'size'       => $product->size,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', '"' . $product->name . '" berhasil ditambahkan ke keranjang.');
    }

    /**
     * Update qty produk di keranjang
     */
    public function update(Request $request, $productId)
    {
        $request->validate(['qty' => 'required|integer|min:1']);

        $cart    = session()->get('cart', []);
        $product = Product::find($productId);

        if (!isset($cart[$productId])) {
            return back()->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        if ($request->qty > $product->stock) {
            return back()->with('error', 'Jumlah melebihi stok tersedia (' . $product->stock . ').');
        }

        $cart[$productId]['qty'] = $request->qty;
        session()->put('cart', $cart);

        return back()->with('success', 'Keranjang diperbarui.');
    }

    /**
     * Hapus produk dari keranjang
     */
    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    /**
     * Kosongkan semua keranjang
     */
    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Keranjang dikosongkan.');
    }

    /**
     * Jumlah item di keranjang (untuk badge navbar)
     */
    public static function count(): int
    {
        return collect(session()->get('cart', []))->sum('qty');
    }
}
