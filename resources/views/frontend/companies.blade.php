@extends('frontend.layouts.app')

@section('content')
    <div class="bg-gray-100 py-12">
        <div class="container-custom">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-6 text-center">Our Companies & Clients</h1>
            <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Proudly working with leading organizations
                globally.</p>

            @if($clients->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8">
                    @foreach($clients as $client)
                        <div
                            class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center justify-center hover:shadow-xl transition-shadow duration-300">
                            <div class="w-32 h-32 flex items-center justify-center mb-4">
                                @if($client->logo)
                                    <img src="{{ asset($client->logo) }}" alt="{{ $client->name }}"
                                        class="max-w-full max-h-full object-contain">
                                @else
                                    <div class="text-4xl text-gray-300 font-bold">{{ substr($client->name, 0, 1) }}</div>
                                @endif
                            </div>
                            <h3 class="text-center font-semibold text-gray-800">{{ $client->name }}</h3>
                            @if($client->url)
                                <a href="{{ $client->url }}" target="_blank" class="text-sm text-indigo-600 mt-2 hover:underline">Visit
                                    Website</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 text-gray-500">
                    <p>No companies listed at the moment.</p>
                </div>
            @endif
        </div>
    </div>
@endsection