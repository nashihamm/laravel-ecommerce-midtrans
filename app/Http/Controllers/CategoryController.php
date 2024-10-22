<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('seller.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('seller.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $slug = Str::slug($request->name);
    
        Category::create(array_merge($validated, ['slug' => $slug]));
    
        return redirect()->route('seller.categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }
    

    public function edit(Category $category)
    {
        return view('seller.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        $slug = Str::slug($request->name);
    
        $category->update(array_merge($validated, ['slug' => $slug]));
    
        return redirect()->route('seller.categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }
    

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = $category->products()->get();

        return view('category.show', [
            'category' => $category,
            'products' => $products
        ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('seller.categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
