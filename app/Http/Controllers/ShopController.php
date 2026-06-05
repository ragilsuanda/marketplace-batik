<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Halaman katalog produk frontend
     */
    public function index(Request $request)
    {
        $categories = Category::withCount('products')->get();

        $query = Product::with('category')->where('stock', '>', 0);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->get();

        return view('frontend.shop.index', compact('products', 'categories'));
    }

    /**
     * Detail produk (via modal / halaman)
     */
    public function show(Product $product)
    {
        $related = Product::with('category')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->take(4)
            ->get();

        return view('frontend.shop.show', compact('product', 'related'));
    }
}
