<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        $categories = Category::all();
        return view('seller.products.index', compact('products', 'categories'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
    
        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $nameParts = explode(' ', $validated['name']);
            $shortName = implode('_', array_slice($nameParts, 0, 2));
    
            $filename = $shortName . '_' . now()->format('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            
            $path = $request->file('image')->storeAs('', $filename, 'uploads');
            $validated['image'] = $path;
        }
    
        Product::create($validated);
    
        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil ditambahkan');
    }
    


    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('seller.products.edit', compact('product','categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);
    
    if ($request->hasFile('image')) {
        if ($product->image) {
            $oldImagePath = public_path('uploads/' . $product->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        $nameParts = explode(' ', $validated['name']);
        $shortName = implode('_', array_slice($nameParts, 0, 2));

        $filename = $shortName . '_' . now()->format('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
        
        $path = $request->file('image')->storeAs('', $filename, 'uploads');
        $validated['image'] = $path;
    }

    
        $product->update($validated);
    
        return redirect()->route('seller.products.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function show($id)
{
    $product = Product::findOrFail($id);

    $cart = Cart::where('user_id', Auth::user()->id)->first();
    $cartItems = $cart ? $cart->cartItems : collect();

    return view('products.show', [
        'product' => $product,
        'cartItems' => $cartItems,
    ]);
}


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('seller.products.index')->with('success','Produk dihapus');
    }
}
