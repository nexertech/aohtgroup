@extends('frontend.layouts.app')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="container-custom">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4 text-center">Our Services</h1>
            <p class="text-center text-gray-600 max-w-3xl mx-auto mb-12">We offer a wide range of comprehensive solutions
                tailored to meet your unique business needs.</p>

            @if($services->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($services as $service)
                        <div
                            class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-2xl transition-all duration-300 group">
                            @if($service->banner_image)
                                <div class="h-48 overflow-hidden">
                                    <img src="{{ asset('storage/' . $service->banner_image) }}" alt="{{ $service->service_name }}"
                                        class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                </div>
                            @endif

                            <div class="p-8">
                                <div class="flex items-center gap-4 mb-4">
                                    @if($service->icon)
                                        <div class="w-12 h-12 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600">
                                            <img src="{{ asset('storage/' . $service->icon) }}" class="w-8 h-8 object-contain">
                                        </div>
                                    @endif
                                    <h3 class="text-2xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">
                                        {{ $service->service_name }}
                                    </h3>
                                </div>

                                <div class="text-gray-600 leading-relaxed mb-6">
                                    {!! \Illuminate\Support\Str::limit(strip_tags($service->description), 200) !!}
                                </div>

                                <a href="{{ route('frontend.services.detail', $service->slug) }}"
                                    class="inline-flex items-center text-indigo-600 font-semibold hover:text-indigo-800 transition-colors">
                                    Learn More
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-20 bg-white rounded-lg shadow">
                    <p class="text-gray-500 text-lg">Services are currently being updated. Please check back later.</p>
                </div>
            @endif
        </div>
    </div>
@endsection