@extends('frontend.layouts.app')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="container-custom">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Contact Us</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Have questions? We'd love to hear from you. Send us a
                    message and we'll respond as soon as possible.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Get in Touch</h2>

                    <div class="space-y-6">
                        @if($company->address)
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div
                                        class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-100 text-indigo-600">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Our Office</h3>
                                    <p class="mt-1 text-gray-600">{{ $company->address }}</p>
                                </div>
                            </div>
                        @endif

                        @if($company->email)
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div
                                        class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-100 text-indigo-600">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Email Us</h3>
                                    <p class="mt-1 text-gray-600">{{ $company->email }}</p>
                                </div>
                            </div>
                        @endif

                        @if($company->phone)
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div
                                        class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-100 text-indigo-600">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Call Us</h3>
                                    <p class="mt-1 text-gray-600">{{ $company->phone }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Send a Message</h2>
                    <form action="#" method="POST"> <!-- Route not yet implemented for store -->
                        @csrf
                        <div class="grid grid-cols-1 gap-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name" autocomplete="name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3 px-4 bg-gray-50"
                                    placeholder="Your Name">
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" autocomplete="email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3 px-4 bg-gray-50"
                                    placeholder="you@example.com">
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                                <textarea id="message" name="message" rows="4"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3 px-4 bg-gray-50"
                                    placeholder="How can we help you?"></textarea>
                            </div>
                            <div>
                                <button type="button" onclick="alert('Contact form submission not yet implemented.')"
                                    class="w-full inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                                    Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection