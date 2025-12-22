@extends('frontend.layouts.app')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="container-custom">
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600">
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <a href="{{ route('frontend.products') }}"
                                class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">
                                Products
                            </a>
                        </div>
                    </li>
                    @if($product->category)
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 9 4-4-4-4" />
                                </svg>
                                <a href="{{ route('frontend.category.detail', $product->category->slug) }}"
                                    class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">
                                    {{ $product->category->category_name }}
                                </a>
                            </div>
                        </li>
                    @endif
                    @if($product->subcategory)
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 9 4-4-4-4" />
                                </svg>
                                <a href="{{ route('frontend.category.detail', $product->subcategory->slug) }}"
                                    class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">
                                    {{ $product->subcategory->category_name }}
                                </a>
                            </div>
                        </li>
                    @endif
                    @if($product->childSubcategory)
                        <li>
                            <div class="flex items-center">
                                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 9 4-4-4-4" />
                                </svg>
                                <a href="{{ route('frontend.category.detail', $product->childSubcategory->slug) }}"
                                    class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">
                                    {{ $product->childSubcategory->category_name }}
                                </a>
                            </div>
                        </li>
                    @endif
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 9 4-4-4-4" />
                            </svg>
                            <span
                                class="ml-1 text-sm font-medium text-gray-500 md:ml-2 truncate">{{ $product->product_name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>


            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <!-- Left: Product Images -->
                    <div class="bg-gray-50 flex gap-4 p-4 lg:p-6" style="min-height: 550px; height: 550px;">
                        <!-- Thumbnails (Vertical) -->
                        @php
                            $allImages = [];
                            if ($product->main_image) {
                                $allImages[] = ['path' => 'storage/' . $product->main_image, 'is_main' => true, 'caption' => 'Main Image'];
                            }
                            foreach ($product->galleries as $gallery) {
                                $allImages[] = ['path' => 'storage/' . $gallery->image_path, 'is_main' => false, 'caption' => $gallery->caption];
                            }
                        @endphp

                        @if(count($allImages) > 1)
                            <div class="hidden lg:flex flex-col gap-3 overflow-y-auto pr-1">
                                @foreach($allImages as $index => $image)
                                    <div class="thumbnail-item w-20 h-24 flex-shrink-0 rounded-lg overflow-hidden cursor-pointer border-2 transition-all duration-300 {{ $index === 0 ? 'border-indigo-600 shadow-sm' : 'border-gray-200 hover:border-indigo-400' }}"
                                        onclick="changeMainImage('{{ asset($image['path']) }}', this)">
                                        <img src="{{ asset($image['path']) }}" class="w-full h-full object-cover object-top">
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Main Image Area -->
                        <div
                            class="flex-1 relative overflow-hidden rounded-2xl bg-white shadow-inner border border-gray-100">
                            @if($product->main_image || $product->galleries->count() > 0)
                                @php
                                    $displayImage = $product->main_image ? 'storage/' . $product->main_image : 'storage/' . $product->galleries->first()->image_path;
                                @endphp
                                <img id="mainProductImage" src="{{ asset($displayImage) }}" alt="{{ $product->product_name }}"
                                    class="absolute inset-0 w-full h-full object-contain p-4 transition-opacity duration-300">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center text-gray-300">
                                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Right: Product Details -->
                    <div class="p-8 lg:px-12 lg:py-6 flex flex-col justify-center">
                        <div class="uppercase tracking-wide text-sm text-indigo-600 font-semibold mb-2">
                            @if($product->childSubcategory)
                                {{ $product->childSubcategory->category_name }}
                            @elseif($product->subcategory)
                                {{ $product->subcategory->category_name }}
                            @elseif($product->category)
                                {{ $product->category->category_name }}
                            @else
                                Product
                            @endif
                        </div>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-4">{{ $product->product_name }}</h1>

                        @if($product->price)
                            <div class="text-3xl font-bold text-indigo-600 mb-6">
                                Rs. {{ number_format($product->price, 2) }}
                            </div>
                        @endif

                        <div class="flex flex-wrap gap-4 mb-6 text-sm text-gray-600">
                            @if($product->client)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Client: <span class="font-medium text-gray-900 ml-1">{{ $product->client }}</span>
                                </div>
                            @endif
                            @if($product->location)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Location: <span class="font-medium text-gray-900 ml-1">{{ $product->location }}</span>
                                </div>
                            @endif
                            @if($product->start_date)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Date: <span
                                        class="font-medium text-gray-900 ml-1">{{ \Carbon\Carbon::parse($product->start_date)->format('M Y') }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="prose prose-indigo text-gray-600 mb-8">
                            {!! $product->description !!}
                        </div>

                        <div class="mt-8 flex gap-4">
                            <button
                                class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-bold rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 transition duration-150 ease-in-out shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                                onclick="addToCart()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Add to Cart
                            </button>
                        </div>

                        <script>
                            function addToCart() {
                                alert('Product added to cart! (Functionality pending)');
                            }
                        </script>
                    </div>
                </div>
            </div>

            <script>
                function changeMainImage(imageSrc, clickedThumbnail) {
                    // Update main image
                    document.getElementById('mainProductImage').src = imageSrc;

                    // Remove active state from all thumbnails
                    document.querySelectorAll('.thumbnail-item').forEach(thumb => {
                        thumb.classList.remove('border-indigo-600');
                        thumb.classList.add('border-gray-200', 'hover:border-indigo-400');
                    });

                    // Add active state to clicked thumbnail
                    clickedThumbnail.classList.remove('border-gray-200', 'hover:border-indigo-400');
                    clickedThumbnail.classList.add('border-indigo-600');
                }
            </script>

            <!-- Related Products -->
            @if($relatedProducts->count() > 0)
                <div class="mt-16">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Products</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $related)
                            <div
                                class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group flex flex-col">
                                <div class="aspect-[3/4] h-80 bg-gray-200 overflow-hidden relative">
                                    @if($related->main_image)
                                        <img src="{{ asset('storage/' . $related->main_image) }}" alt="{{ $related->product_name }}"
                                            class="w-full h-full object-cover object-top group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                            <span class="text-xs font-bold uppercase tracking-widest">No Image</span>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-all duration-300">
                                    </div>
                                </div>
                                <div class="p-5 flex flex-col flex-grow">
                                    <h3
                                        class="text-[17px] font-extrabold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors line-clamp-2 leading-tight">
                                        {{ $related->product_name }}
                                    </h3>
                                    <div class="mt-auto pt-4">
                                        <a href="{{ route('frontend.products.detail', $related->slug) }}"
                                            class="inline-flex items-center text-indigo-600 font-bold text-sm group/link">
                                            <span class="mr-2">View Details</span>
                                            <svg class="w-4 h-4 transform group-hover/link:translate-x-1 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection