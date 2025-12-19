@extends('frontend.layouts.app')

@section('content')
    <div class="bg-gray-50 py-16">
        <div class="container-custom">
            <div class="text-center mb-16">
                <h1 class="text-5xl font-extrabold text-gray-900 mb-6">Contact Us</h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    A One Home Textile Group is committed to excellence in quality and innovation.
                    Whether you have inquiries about our premium textile products, partnership opportunities,
                    or need expert assistance, we're here to help you weave success.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
                <!-- Contact Form (Now on Left) -->
                <div class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8 flex items-center">
                        <svg class="h-8 w-8 text-indigo-600 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Send a Message
                    </h2>

                    @if(session('success'))
                        <div class="mb-8 p-5 bg-green-50 border-l-4 border-green-500 text-green-800 rounded-r-lg shadow-sm">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('frontend.contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" autocomplete="name"
                                    class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-4 px-5 bg-gray-50 border transition-all duration-200 @error('name') border-red-500 @enderror"
                                    placeholder="John Doe" required>
                                @error('name') <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email
                                    Address</label>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" autocomplete="email"
                                    class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-4 px-5 bg-gray-50 border transition-all duration-200 @error('email') border-red-500 @enderror"
                                    placeholder="john@example.com" required>
                                @error('email') <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number
                                (Optional)</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                                class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-4 px-5 bg-gray-50 border transition-all duration-200"
                                placeholder="+92 300 0000000">
                            @error('phone') <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">Subject</label>
                            <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
                                class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-4 px-5 bg-gray-50 border transition-all duration-200"
                                placeholder="How can we help?">
                            @error('subject') <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Your Message</label>
                            <textarea id="message" name="message" rows="5"
                                class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-4 px-5 bg-gray-50 border transition-all duration-200 @error('message') border-red-500 @enderror"
                                placeholder="Write your message here..." required>{{ old('message') }}</textarea>
                            @error('message') <p class="mt-2 text-xs text-red-500 font-medium">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full inline-flex justify-center items-center py-4 px-8 border border-transparent shadow-lg text-lg font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-300 transform hover:-translate-y-1">
                                Send Message
                                <svg class="ml-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Contact Info (Now on Right) -->
                <div class="space-y-8">
                    <div
                        class="bg-indigo-600 rounded-3xl shadow-2xl p-10 text-white transform hover:scale-[1.02] transition-all duration-300">
                        <h2 class="text-3xl font-bold mb-8 flex items-center">
                            <svg class="h-8 w-8 text-indigo-200 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Get in Touch
                        </h2>

                        <div class="space-y-10">
                            @if($company->address)
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-indigo-500 p-3 rounded-2xl">
                                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-6">
                                        <h3 class="text-xl font-bold text-indigo-100">Global Headquarters</h3>
                                        <p class="mt-2 text-lg text-white leading-relaxed">{{ $company->address }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($company->email)
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-indigo-500 p-3 rounded-2xl">
                                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-6">
                                        <h3 class="text-xl font-bold text-indigo-100">Email Inquiry</h3>
                                        <p class="mt-2 text-lg text-white font-medium">{{ $company->email }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($company->phone)
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-indigo-500 p-3 rounded-2xl">
                                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div class="ml-6">
                                        <h3 class="text-xl font-bold text-indigo-100">Call Support</h3>
                                        <p class="mt-2 text-lg text-white font-medium">{{ $company->phone }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="mt-12 pt-8 border-t border-indigo-500 flex gap-6">
                            <a href="#"
                                class="bg-indigo-500 p-3 rounded-xl hover:bg-white hover:text-indigo-600 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="bg-indigo-500 p-3 rounded-xl hover:bg-white hover:text-indigo-600 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path
                                        d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="bg-indigo-500 p-3 rounded-xl hover:bg-white hover:text-indigo-600 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="currentColor">
                                    <path
                                        d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="bg-indigo-500 p-3 rounded-xl hover:bg-white hover:text-indigo-600 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Additional Content -->
                    <div class="bg-white rounded-3xl p-10 border border-gray-100 shadow-sm">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Business Hours</h3>
                        <div class="space-y-3 text-gray-600">
                            <div class="flex justify-between">
                                <span>Monday - Friday</span>
                                <span class="font-semibold">09:00 AM - 06:00 PM</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Saturday</span>
                                <span class="font-semibold">09:00 AM - 02:00 PM</span>
                            </div>
                            <div class="flex justify-between text-indigo-600 font-medium">
                                <span>Sunday</span>
                                <span>Closed</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection