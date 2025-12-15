@extends('frontend.layouts.app')

@section('content')
    <div class="bg-gray-100 py-12">
        <div class="container-custom">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-6 text-center">Careers</h1>
            <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Join our dynamic team and help us shape the future.
            </p>

            @if($jobs->count() > 0)
                <div class="space-y-6 max-w-4xl mx-auto">
                    @foreach($jobs as $job)
                        <div
                            class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow border-l-4 border-indigo-500">
                            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-800">{{ $job->title }}</h2>
                                    <div class="text-sm text-gray-500 mt-1 flex gap-4">
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            {{ $job->department }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ $job->location ?? 'Remote' }}
                                        </span>
                                        <span
                                            class="bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded text-xs font-semibold self-center">
                                            {{ $job->job_type ?? 'Full Time' }}
                                        </span>
                                    </div>
                                </div>
                                <button
                                    class="mt-4 md:mt-0 bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                                    Apply Now
                                </button>
                            </div>

                            <div class="text-gray-600 mb-4 prose max-w-none">
                                {!! \Illuminate\Support\Str::limit(strip_tags($job->description), 250) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-lg shadow-md p-10 text-center max-w-2xl mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">No Openings Currently</h3>
                    <p class="text-gray-600">We don't have any open positions right now, but please check back soon or send us
                        your resume.</p>
                </div>
            @endif
        </div>
    </div>
@endsection