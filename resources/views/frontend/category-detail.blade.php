@extends('frontend.layouts.app')

@section('content')
<div class="bg-gray-100 py-12">
    <div class="container-custom">
        <!-- Breadcrumb / Header -->
        <div class="mb-8 text-center">
            @if($category->parent)
                <nav class="flex justify-center mb-4 text-sm font-medium text-gray-500">
                    <a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors">Home</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('frontend.category.detail', $category->parent->slug) }}" class="hover:text-indigo-600 transition-colors">{{ $category->parent->category_name }}</a>
                    <span class="mx-2">/</span>
                    <span class="text-indigo-600">{{ $category->category_name }}</span>
                </nav>
            @endif

            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">{{ $category->category_name }}</h1>
            <p class="text-gray-600">
                @if($subcategories->count() > 0)
                    Explore our specific solutions and offerings in this category.
                @else
                    Browse our products in this category.
                @endif
            </p>
        </div>

        @if($subcategories->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($subcategories as $sub)
                    <!-- Added anchor tag to make entire card clickable -->
                    <a href="{{ route('frontend.category.detail', $sub->slug) }}" class="block group">
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 h-full flex flex-col">
                            <div class="bg-gray-200 overflow-hidden relative" style="height: 400px;"> <!-- Force equal height -->
                                @if($sub->image)
                                    <img src="{{ asset('storage/' . $sub->image) }}" alt="{{ $sub->category_name }}" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400 font-bold text-3xl">
                                        {{ substr($sub->category_name, 0, 1) }}
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300"></div>
                            </div>
                            <div class="p-6 text-center mt-auto">
                                <h3 class="text-xl font-bold text-gray-800 group-hover:text-indigo-600 transition-colors">{{ $sub->category_name }}</h3>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

        @elseif(isset($products) && $products->count() > 0)
            <!-- Product Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group flex flex-col h-full">
                        <a href="{{ route('frontend.products.detail', $product->slug) }}" class="flex flex-col h-full">
                            <div class="bg-gray-200 overflow-hidden relative" style="height: 400px;"> <!-- Force equal height -->
                                @if($product->main_image)
                                    <img src="{{ asset($product->main_image) }}" alt="{{ $product->product_name }}" class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        <span>No Image</span>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300"></div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">{{ $product->product_name }}</h3>
                                @if($product->price)
                                    <p class="text-indigo-600 font-semibold mb-2">Rs. {{ number_format($product->price, 2) }}</p>
                                @endif
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($product->description), 100) }}</p>
                                <span class="text-indigo-600 font-medium text-sm flex items-center mt-3">
                                    View Details 
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        @else
            <!-- No Subcategories AND No Products -->
            <div class="text-center py-20 bg-white rounded-lg shadow">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No content found</h3>
                <p class="mt-1 text-sm text-gray-500">Check back later for new additions in this category.</p>
                <div class="mt-6">
                    <a href="{{ url('/') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Go Back Home
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
