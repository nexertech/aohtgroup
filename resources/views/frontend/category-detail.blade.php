@extends('frontend.layouts.app')

@section('content')
<div class="bg-gray-100 py-12">
    <div class="container-custom">
        <!-- Breadcrumb / Header -->
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2">{{ $category->category_name }}</h1>
            <p class="text-gray-600">Explore our specific solutions and offerings in this category.</p>
        </div>

        @if($subcategories->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($subcategories as $sub)
                    <div class="block group">
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="h-48 bg-gray-200 overflow-hidden relative">
                                @if($sub->image)
                                    <img src="{{ asset('storage/' . $sub->image) }}" alt="{{ $sub->category_name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400 font-bold text-3xl">
                                        {{ substr($sub->category_name, 0, 1) }}
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300"></div>
                            </div>
                            <div class="p-6 text-center">
                                <h3 class="text-xl font-bold text-gray-800">{{ $sub->category_name }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Leaf Node: Show Products if requested, or just empty state for now -->
            <div class="text-center py-20 bg-white rounded-lg shadow">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No subcategories found</h3>
                <p class="mt-1 text-sm text-gray-500">Check back later for new additions.</p>
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
