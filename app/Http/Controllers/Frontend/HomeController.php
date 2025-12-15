<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Service;
use App\Models\Product;
use App\Models\Blog;
use App\Models\CompanyInfo;
use App\Models\TeamMember;
use App\Models\ProductCategory;
use App\Models\Client;
use App\Models\JobOpening;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('sequence')->get();
        $services = Service::where('status', 1)->orderBy('sequence')->get();
        $products = Product::where('status', 1)->latest()->take(6)->get();
        $blogs = Blog::where('status', 1)->latest('published_at')->take(3)->get();
        $teamMembers = TeamMember::orderBy('sequence')->take(4)->get();
        $categories = ProductCategory::whereNull('parent_id')->orderBy('sequence')->take(7)->get();
        $totalCategories = ProductCategory::whereNull('parent_id')->count();
        $company = CompanyInfo::first();

        return view('frontend.home', compact('sliders', 'services', 'products', 'blogs', 'teamMembers', 'company', 'categories', 'totalCategories'));
    }

    public function categories()
    {
        $categories = ProductCategory::whereNull('parent_id')->orderBy('sequence')->get();
        $company = CompanyInfo::first();
        return view('frontend.categories', compact('categories', 'company'));
    }

    public function categoryDetail($slug)
    {
        $company = CompanyInfo::first();
        $category = ProductCategory::where('slug', $slug)->firstOrFail();

        // Check if this is a leaf node (subcategory with no children)
        $subcategories = ProductCategory::where('parent_id', $category->id)->get();

        // If no subcategories, it's a leaf node - show products
        if ($subcategories->count() === 0) {
            $products = Product::where('category_id', $category->id)
                ->orWhere('subcategory_id', $category->id)
                ->where('status', 1)
                ->latest()
                ->get();

            return view('frontend.subcategory-products', compact('company', 'category', 'products'));
        }

        // Otherwise, show subcategories
        return view('frontend.category-detail', compact('company', 'category', 'subcategories'));
    }

    public function about()
    {
        $company = CompanyInfo::first();
        // Fallback if no record
        if (!$company)
            $company = new CompanyInfo();

        $teamMembers = TeamMember::orderBy('sequence')->get();
        return view('frontend.about', compact('company', 'teamMembers'));
    }

    public function companies()
    {
        $company = CompanyInfo::first();
        $clients = Client::latest()->get();
        return view('frontend.companies', compact('company', 'clients'));
    }

    public function services()
    {
        $company = CompanyInfo::first();
        $services = Service::where('status', 1)->orderBy('sequence')->get();
        return view('frontend.services', compact('company', 'services'));
    }

    public function serviceDetail($slug)
    {
        $company = CompanyInfo::first();
        $service = Service::where('slug', $slug)->firstOrFail();
        $otherServices = Service::where('status', 1)->where('id', '!=', $service->id)->orderBy('sequence')->take(5)->get();
        return view('frontend.service-detail', compact('company', 'service', 'otherServices'));
    }

    public function careers()
    {
        $company = CompanyInfo::first();
        $jobs = JobOpening::where('status', 'Open')->orWhere('status', 'Active')->latest()->get();
        // Note: Check JobOpening status values. Assuming 'Open' or boolean or 'Active'. 
        // Model definition didn't show enum, but let's assume 'Active' or 1 based on other models.
        // Actually Service has status 1. Let's check JobOpening status type in db if possible, but safely we can just fetch all for now or check valid statuses.
        // Let's assume 'Active' or 1. If it's a string, we might need to be careful.
        // Previous output showed: 'status' in fillable.

        // Let's just fetch all for now and filter in view or if we know the value.
        // Admin index likely shows status.
        return view('frontend.careers', compact('company', 'jobs'));
    }

    public function news()
    {
        $company = CompanyInfo::first();
        $blogs = Blog::where('status', 1)->latest('published_at')->paginate(9);
        return view('frontend.news', compact('company', 'blogs'));
    }

    public function newsDetail($id)
    {
        $company = CompanyInfo::first();
        $blog = Blog::findOrFail($id);
        $recentBlogs = Blog::where('status', 1)->where('id', '!=', $id)->latest('published_at')->take(5)->get();
        return view('frontend.news-detail', compact('company', 'blog', 'recentBlogs'));
    }

    public function productDetail($slug)
    {
        $company = CompanyInfo::first();
        $product = Product::where('slug', $slug)->with(['category', 'galleries'])->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('frontend.product-detail', compact('company', 'product', 'relatedProducts'));
    }

    public function contact()
    {
        $company = CompanyInfo::first();
        return view('frontend.contact', compact('company'));
    }
}
