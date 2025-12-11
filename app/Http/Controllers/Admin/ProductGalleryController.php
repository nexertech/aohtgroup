<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = ProductGallery::with('product')->latest()->paginate(10);
        return view('admin.product_galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.product_galleries.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['product_id', 'caption']);

        if ($request->hasFile('image_path')) {
            $path = $request->file('image_path')->store('product_galleries', 'public');
            $data['image_path'] = $path;
        }

        ProductGallery::create($data);

        return redirect()->route('admin.product-galleries.index')->with('success', 'Gallery image added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductGallery $productGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductGallery $productGallery)
    {
        $products = Product::all();
        return view('admin.product_galleries.edit', compact('productGallery', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductGallery $productGallery)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        $data = $request->only(['product_id', 'caption']);

        if ($request->hasFile('image_path')) {
            // Delete old image
            if ($productGallery->image_path) {
                Storage::disk('public')->delete($productGallery->image_path);
            }
            $path = $request->file('image_path')->store('product_galleries', 'public');
            $data['image_path'] = $path;
        }

        $productGallery->update($data);

        return redirect()->route('admin.product-galleries.index')->with('success', 'Gallery image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductGallery $productGallery)
    {
        if ($productGallery->image_path) {
            Storage::disk('public')->delete($productGallery->image_path);
        }

        $productGallery->delete();

        return redirect()->route('admin.product-galleries.index')->with('success', 'Gallery image deleted successfully.');
    }
}
