<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug',
            'content' => 'nullable|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
        ]);

        $data = $request->except('banner_image');

        // Auto-generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($request->title);
        }

        if ($request->hasFile('banner_image')) {
            $data['banner_image'] = $request->file('banner_image')->store('pages', 'public');
        }

        Page::create($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:pages,slug,' . $page->id,
            'content' => 'nullable|string',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
        ]);

        $data = $request->except('banner_image');

        // Auto-generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($request->title);
        }

        if ($request->hasFile('banner_image')) {
            // Delete old image
            if ($page->banner_image) {
                Storage::disk('public')->delete($page->banner_image);
            }
            $data['banner_image'] = $request->file('banner_image')->store('pages', 'public');
        }

        $page->update($data);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        if ($page->banner_image) {
            Storage::disk('public')->delete($page->banner_image);
        }

        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
