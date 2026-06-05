<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('backend.product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('backend.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'size'        => 'nullable|string|max:100',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_2'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_3'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        Product::create([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'size'        => $request->size,
            'image'       => $request->hasFile('image')   ? $request->file('image')->store('products', 'public')   : null,
            'image_2'     => $request->hasFile('image_2') ? $request->file('image_2')->store('products', 'public') : null,
            'image_3'     => $request->hasFile('image_3') ? $request->file('image_3')->store('products', 'public') : null,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('backend.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'size'        => 'nullable|string|max:100',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_2'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_3'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'size'        => $request->size,
        ];

        // Handle masing-masing foto
        foreach (['image', 'image_2', 'image_3'] as $field) {
            if ($request->hasFile($field)) {
                if ($product->$field) {
                    Storage::disk('public')->delete($product->$field);
                }
                $data[$field] = $request->file($field)->store('products', 'public');
            }
        }

        $product->update($data);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        foreach (['image', 'image_2', 'image_3'] as $field) {
            if ($product->$field) {
                Storage::disk('public')->delete($product->$field);
            }
        }
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
