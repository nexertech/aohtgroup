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
        $categories = ProductCategory::whereNull('parent_id')->get();
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
            'subcategory_id' => 'nullable|exists:product_categories,id',
            'child_subcategory_id' => 'nullable|exists:product_categories,id',
            'description' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'price' => 'nullable|numeric|min:0',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
            'status' => 'boolean',
        ]);

        $data = $request->all();
        $data['slug'] = $this->generateUniqueSlug($request->product_name);

        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('products', 'public');
            $data['main_image'] = $path;
        }

        $product = Product::create($data);

        // Handle Gallery Images
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('product_galleries', 'public');
                \App\Models\ProductGallery::create([
                    'product_id' => $product->id,
                    'image_path' => $path
                ]);
            }
        }

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
        $categories = ProductCategory::whereNull('parent_id')->get();
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
            'subcategory_id' => 'nullable|exists:product_categories,id',
            'child_subcategory_id' => 'nullable|exists:product_categories,id',
            'description' => 'nullable|string',
            'client' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'price' => 'nullable|numeric|min:0',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
            'status' => 'boolean',
        ]);

        $data = $request->all();
        $data['slug'] = $this->generateUniqueSlug($request->product_name, $product->id);

        // Handle checkbox for status (if unchecked it's absent from request)
        $data['status'] = $request->has('status') ? 1 : 0;

        if ($request->hasFile('main_image')) {
            // Delete old image if exists
            if ($product->main_image) {
                Storage::disk('public')->delete($product->main_image);
            }

            $path = $request->file('main_image')->store('products', 'public');
            $data['main_image'] = $path;
        }

        $product->update($data);

        // Handle Gallery Images (Append new ones)
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('product_galleries', 'public');
                \App\Models\ProductGallery::create([
                    'product_id' => $product->id,
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete main image
        if ($product->main_image) {
            Storage::disk('public')->delete($product->main_image);
        }

        // Delete gallery images
        foreach ($product->galleries as $gallery) {
            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            $gallery->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * Delete a specific gallery image.
     */
    public function deleteGalleryImage($id)
    {
        try {
            $gallery = \App\Models\ProductGallery::findOrFail($id);

            if ($gallery->image_path) {
                Storage::disk('public')->delete($gallery->image_path);
            }

            $gallery->delete();

            return response()->json([
                'success' => true,
                'message' => 'Gallery image deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting image: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Generate a unique slug for the product.
     *
     * @param string $name
     * @param int|null $ignoreId
     * @return string
     */
    private function generateUniqueSlug($name, $ignoreId = null)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        // Check if slug exists
        while (Product::where('slug', $slug)->where('id', '!=', $ignoreId)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
