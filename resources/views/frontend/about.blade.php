@extends('frontend.layouts.app')

@section('content')
    <div class="bg-gray-100 py-12">
        <div class="container-custom">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-6 text-center">About Us</h1>

            <!-- Company Info Section -->
            <div class="bg-white rounded-lg shadow-lg p-8 mb-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                    <div>
                        @if($company->about_image)
                            @if(\Illuminate\Support\Str::startsWith($company->about_image, ['http://', 'https://']))
                                <img src="{{ $company->about_image }}" alt="About Us"
                                    class="rounded-lg shadow-md w-full h-auto object-cover">
                            @elseif(file_exists(public_path('storage/' . $company->about_image)))
                                <img src="{{ asset('storage/' . $company->about_image) }}" alt="About Us"
                                    class="rounded-lg shadow-md w-full h-auto object-cover">
                            @elseif(file_exists(public_path($company->about_image)))
                                <img src="{{ asset($company->about_image) }}" alt="About Us"
                                    class="rounded-lg shadow-md w-full h-auto object-cover">
                            @else
                                <!-- Fallback if file not found -->
                                <div class="bg-gray-200 rounded-lg h-64 flex items-center justify-center text-gray-500 flex-col">
                                    <span>Image Not Found</span>
                                </div>
                            @endif
                        @else
                            <div class="bg-gray-200 rounded-lg h-64 flex items-center justify-center text-gray-500 flex-col">
                                <span>No Image Uploaded</span>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $company->company_name ?? 'AOHT Group' }}</h2>
                        <div class="prose max-w-none text-gray-600">
                            {!! $company->about ?? 'We are dedicated to providing the best solutions for our clients.' !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mission & Vision -->
            @if($company->mission || $company->vision)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    @if($company->mission)
                        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-indigo-500">
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Our Mission</h3>
                            <p class="text-gray-600">{{ $company->mission }}</p>
                        </div>
                    @endif
                    @if($company->vision)
                        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-cyan-500">
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Our Vision</h3>
                            <p class="text-gray-600">{{ $company->vision }}</p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Team Section -->
            @if($teamMembers->count() > 0)
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Meet Our Team</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($teamMembers as $member)
                            <div
                                class="bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
                                <div class="h-64 bg-gray-200 overflow-hidden">
                                    @if($member->photo)
                                        <img src="{{ asset($member->photo) }}" alt="{{ $member->name }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-indigo-100 text-indigo-500 text-4xl font-bold">
                                            {{ substr($member->name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="p-4 text-center">
                                    <h3 class="text-lg font-bold text-gray-800">{{ $member->name }}</h3>
                                    <p class="text-indigo-600 font-medium">{{ $member->position }}</p>
                                    @if($member->bio)
                                        <p class="text-gray-500 text-sm mt-2 line-clamp-3">{{ strip_tags($member->bio) }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection