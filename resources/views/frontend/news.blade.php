@extends('frontend.layouts.app')

@section('content')
    <div class="bg-gray-50 py-12">
        <div class="container-custom">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-2 text-center">News & Insights</h1>
            <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Latest updates from AOHT Group.</p>

            @if($blogs->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($blogs as $blog)
                        <div
                            class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300 flex flex-col h-full">
                            <a href="{{ route('frontend.news.detail', $blog->id) }}"
                                class="block h-48 overflow-hidden relative group">
                                @if($blog->thumbnail)
                                    <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-3xl">📰
                                    </div>
                                @endif
                                <div
                                    class="absolute top-0 left-0 bg-white/90 backdrop-blur-sm text-gray-700 text-xs font-bold px-3 py-1.5 m-4 rounded-lg shadow-sm flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-indigo-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $blog->published_at ? $blog->published_at->format('M d, Y') : 'News' }}
                                </div>

                                @if($blog->author)
                                    <div
                                        class="absolute bottom-0 left-0 bg-indigo-600 text-white text-xs font-bold px-3 py-1.5 m-4 rounded-lg shadow-lg flex items-center gap-1.5">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ $blog->author->name }}
                                    </div>
                                @endif
                            </a>

                            <div class="p-6 flex flex-col flex-1">
                                <h3 class="text-xl font-bold text-gray-900 mb-3 leading-tight">
                                    <a href="{{ route('frontend.news.detail', $blog->id) }}"
                                        class="hover:text-indigo-600 transition-colors">
                                        {{ $blog->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 mb-4 flex-1">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($blog->summary ?? $blog->content), 120) }}
                                </p>
                                <a href="{{ route('frontend.news.detail', $blog->id) }}"
                                    class="text-indigo-600 font-semibold hover:text-indigo-800 inline-flex items-center mt-auto">
                                    Read Full Story
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20"
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

                <div class="mt-12 flex justify-center">
                    {{ $blogs->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <p class="text-gray-500 text-lg">No news articles found.</p>
                </div>
            @endif
        </div>
    </div>
@endsection