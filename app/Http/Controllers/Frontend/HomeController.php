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

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('sequence')->get();
        $services = Service::where('status', 1)->orderBy('sequence')->get();
        $products = Product::where('status', 1)->latest()->take(6)->get();
        $blogs = Blog::where('status', 1)->latest('published_at')->take(3)->get();
        $teamMembers = TeamMember::orderBy('sequence')->take(4)->get();
        $company = CompanyInfo::first();

        return view('frontend.home', compact('sliders', 'services', 'products', 'blogs', 'teamMembers', 'company'));
    }
}
