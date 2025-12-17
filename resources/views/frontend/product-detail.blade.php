@extends('frontend.layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container-custom">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600">
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Products</span>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 truncate">{{ $product->product_name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <!-- Left: Product Images -->
                <div class="h-full bg-gray-50 flex gap-4 p-4 lg:p-6" style="min-height: 800px;">
                    <!-- Thumbnails (Vertical) -->
                    @php
                        $allImages = [];
                        if($product->main_image) {
                            $allImages[] = ['path' => $product->main_image, 'is_main' => true, 'caption' => 'Main Image'];
                        }
                        foreach($product->galleries as $gallery) {
                            $allImages[] = ['path' => 'storage/' . $gallery->image_path, 'is_main' => false, 'caption' => $gallery->caption];
                        }
                    @endphp

                    @if(count($allImages) > 1)
                    <div class="hidden lg:flex flex-col gap-4">
                        @foreach($allImages as $index => $image)
                            <div class="w-20 h-28 rounded-md overflow-hidden cursor-pointer border-2 {{ $index === 0 ? 'border-indigo-600' : 'border-transparent hover:border-gray-300' }}"
                                 onclick="changeMainImage('{{ asset($image['path']) }}', this)">
                                <img src="{{ asset($image['path']) }}" class="w-full h-full object-cover object-top">
                            </div>
                        @endforeach
                    </div>
                    @endif

                    <!-- Main Image Area -->
                    <div class="flex-1 relative overflow-hidden rounded-lg bg-gray-200">
                         @if($product->main_image || $product->galleries->count() > 0)
                            @php
                                $displayImage = $product->main_image ?? 'storage/' . $product->galleries->first()->image_path;
                            @endphp
                            <!-- Forced Portrait Aspect Ratio via Height -->
                            <img id="mainProductImage" 
                                 src="{{ asset($displayImage) }}" 
                                 alt="{{ $product->product_name }}" 
                                 class="absolute inset-0 w-full h-full object-cover object-top">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center text-gray-400">
                                <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Right: Product Details -->
                <div class="p-8 lg:p-12 flex flex-col justify-center">
                    <div class="uppercase tracking-wide text-sm text-indigo-600 font-semibold mb-2">
                        {{ $product->category ? $product->category->category_name : 'Product' }}
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
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                Client: <span class="font-medium text-gray-900 ml-1">{{ $product->client }}</span>
                            </div>
                        @endif
                        @if($product->location)
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Location: <span class="font-medium text-gray-900 ml-1">{{ $product->location }}</span>
                            </div>
                        @endif
                        @if($product->start_date)
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                Date: <span class="font-medium text-gray-900 ml-1">{{ \Carbon\Carbon::parse($product->start_date)->format('M Y') }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="prose prose-indigo text-gray-600 mb-8">
                        {!! $product->description !!}
                    </div>

                    <!-- <div class="mt-auto">
                        <a href="{{ route('frontend.contact') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition duration-150 ease-in-out shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            Inquire About This Product
                        </a>
                    </div> -->
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
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group">
                            <div class="h-[500px] bg-gray-200 overflow-hidden relative">
                                @if($related->main_image)
                                    <img src="{{ asset($related->main_image) }}" alt="{{ $related->product_name }}" class="w-full h-full object-cover object-top group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        <span>No Image</span>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300"></div>
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">{{ $related->product_name }}</h3>
                                <a href="{{ route('frontend.products.detail', $related->slug) }}" class="text-indigo-600 font-medium text-sm hover:text-indigo-800 flex items-center mt-3">
                                    View Details <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
