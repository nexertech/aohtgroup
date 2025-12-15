@extends('frontend.layouts.app')

@section('content')
    <div class="bg-gray-100 py-12">
        <div class="container-custom">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        @if($service->banner_image)
                            <div class="h-64 md:h-80 w-full overflow-hidden">
                                <img src="{{ asset('storage/' . $service->banner_image) }}" alt="{{ $service->service_name }}"
                                    class="w-full h-full object-cover">
                            </div>
                        @else
                            <div
                                class="h-48 bg-gradient-to-r from-indigo-500 to-purple-600 flex items-center justify-center text-white text-4xl">
                                {{ substr($service->service_name, 0, 1) }}
                            </div>
                        @endif

                        <div class="p-8">
                            <div class="flex items-center gap-4 mb-6">
                                @if($service->icon)
                                    <div class="w-16 h-16 bg-indigo-50 rounded-lg flex items-center justify-center p-2">
                                        <img src="{{ asset('storage/' . $service->icon) }}"
                                            class="w-full h-full object-contain">
                                    </div>
                                @endif
                                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">{{ $service->service_name }}
                                </h1>
                            </div>

                            <div class="prose max-w-none text-gray-700 leading-relaxed text-lg">
                                {!! $service->description !!}
                            </div>

                            <div class="mt-8 pt-8 border-t border-gray-100">
                                <h3 class="text-lg font-bold text-gray-900 mb-4">Interested in this service?</h3>
                                <a href="#"
                                    class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                                    Contact Us Today
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg p-6 mb-8 sticky top-24">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 pb-2 border-b border-gray-100">Other Services</h3>
                        <div class="space-y-4">
                            @foreach($otherServices as $other)
                                <a href="{{ route('frontend.services.detail', $other->slug) }}"
                                    class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors group">
                                    @if($other->icon)
                                        <div
                                            class="w-10 h-10 flex-shrink-0 bg-indigo-50 rounded-md p-1 mr-3 flex items-center justify-center">
                                            <img src="{{ asset('storage/' . $other->icon) }}" class="w-6 h-6 object-contain">
                                        </div>
                                    @else
                                        <div
                                            class="w-10 h-10 flex-shrink-0 bg-gray-100 rounded-md mr-3 flex items-center justify-center text-gray-500 font-bold">
                                            {{ substr($other->service_name, 0, 1) }}
                                        </div>
                                    @endif
                                    <span
                                        class="font-medium text-gray-700 group-hover:text-indigo-600 transition-colors">{{ $other->service_name }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 ml-auto text-gray-400 group-hover:text-indigo-500" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            @endforeach
                        </div>
                        <div class="mt-6 pt-6 border-t border-gray-100 text-center">
                            <a href="{{ route('frontend.services') }}"
                                class="text-indigo-600 font-semibold hover:text-indigo-800 text-sm">View All Services</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection