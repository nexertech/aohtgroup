<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Always show top-level categories, but eager load children for the modal
        $categories = ProductCategory::with('children')->whereNull('parent_id')->latest()->paginate(10);

        return view('admin.product_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProductCategory::whereNull('parent_id')->get();
        return view('admin.product_categories.create', compact('categories'));
    }

    public function getSubcategories($id)
    {
        $subcategories = ProductCategory::where('parent_id', $id)->get();
        return response()->json($subcategories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:150',
            'slug' => 'required|string|max:150|unique:product_categories',
            'parent_id' => 'nullable|exists:product_categories,id',
        ]);

        if ($request->missing('slug') || is_null($request->slug)) {
            $validatedData['slug'] = Str::slug($validatedData['category_name']);
        }

        ProductCategory::create($validatedData);

        return redirect()->route('admin.product-categories.index')->with('success', 'Product Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        $categories = ProductCategory::whereNull('parent_id')->where('id', '!=', $productCategory->id)->get();
        return view('admin.product_categories.edit', compact('productCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:150',
            'slug' => 'required|string|max:150|unique:product_categories,slug,' . $productCategory->id,
            'parent_id' => 'nullable|exists:product_categories,id',
        ]);

        $productCategory->update($validatedData);

        return redirect()->route('admin.product-categories.index')->with('success', 'Product Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();

        return redirect()->route('admin.product-categories.index')->with('success', 'Product Category deleted successfully.');
    }
}
