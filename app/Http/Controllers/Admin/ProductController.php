<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:product_categories,id',
            'description' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'boolean',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->product_name);

        if ($request->hasFile('main_image')) {
            $imageName = time() . '.' . $request->main_image->extension();
            $request->main_image->move(public_path('images/products'), $imageName);
            $data['main_image'] = 'images/products/' . $imageName;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'nullable|exists:product_categories,id',
            'description' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'boolean',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->product_name);

        // Handle checkbox for status (if unchecked it's absent from request)
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('main_image')) {
            // Delete old image if exists
            if ($product->main_image && file_exists(public_path($product->main_image))) {
                unlink(public_path($product->main_image));
            }

            $imageName = time() . '.' . $request->main_image->extension();
            $request->main_image->move(public_path('images/products'), $imageName);
            $data['main_image'] = 'images/products/' . $imageName;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->main_image && file_exists(public_path($product->main_image))) {
            unlink(public_path($product->main_image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
