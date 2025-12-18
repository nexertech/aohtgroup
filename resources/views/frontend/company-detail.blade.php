@extends('frontend.layouts.app')

@section('content')
    <div class="bg-gray-100 min-h-screen pb-20">
        <!-- Hero Section -->
        <div class="relative bg-gradient-to-r from-indigo-700 to-blue-800 py-24 text-white overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <svg class="h-full w-full" preserveAspectRatio="none" viewBox="0 0 100 100" fill="currentColor">
                    <polygon points="0,0 100,0 100,100" />
                </svg>
            </div>
            <div class="container-custom relative z-10">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div
                        class="w-32 h-32 md:w-48 md:h-48 bg-white rounded-2xl p-4 shadow-2xl flex items-center justify-center overflow-hidden">
                        @if ($targetCompany->logo)
                            <img src="{{ \Illuminate\Support\Str::startsWith($targetCompany->logo, ['http', 'https']) ? $targetCompany->logo : asset('storage/' . $targetCompany->logo) }}"
                                alt="{{ $targetCompany->company_name }}" class="max-w-full max-h-full object-contain">
                        @else
                            <div class="text-5xl font-bold text-gray-300">{{ substr($targetCompany->company_name, 0, 1) }}</div>
                        @endif
                    </div>
                    <div class="text-center md:text-left">
                        <h1 class="text-4xl md:text-6xl font-extrabold mb-4">{{ $targetCompany->company_name }}</h1>
                        @if ($targetCompany->tagline)
                            <p class="text-xl md:text-2xl text-indigo-100 font-medium max-w-2xl">
                                {{ $targetCompany->tagline }}
                            </p>
                        @endif

                        <div class="mt-8 flex flex-wrap justify-center md:justify-start gap-4">
                            @if($targetCompany->email)
                                <div class="flex items-center bg-white/10 px-4 py-2 rounded-full backdrop-blur-sm">
                                    <i class="fas fa-envelope mr-2"></i>
                                    <span class="text-sm">{{ $targetCompany->email }}</span>
                                </div>
                            @endif
                            @if($targetCompany->phone)
                                <div class="flex items-center bg-white/10 px-4 py-2 rounded-full backdrop-blur-sm">
                                    <i class="fas fa-phone mr-2"></i>
                                    <span class="text-sm">{{ $targetCompany->phone }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-custom -mt-10 relative z-20">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- About Section -->
                    <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 border border-gray-100">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <span class="w-2 h-8 bg-indigo-600 rounded-full mr-4"></span>
                            Company Overview
                        </h2>
                        <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                            {!! $targetCompany->about ?? 'Profile content coming soon.' !!}
                        </div>
                    </div>

                    <!-- Mission & Vision -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @if($targetCompany->mission)
                            <div
                                class="bg-gradient-to-br from-indigo-50 to-white rounded-2xl p-8 border border-indigo-100 shadow-sm">
                                <div
                                    class="w-12 h-12 bg-indigo-600 text-white rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-indigo-200">
                                    <i class="fas fa-bullseye text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-indigo-900 mb-4">Our Mission</h3>
                                <p class="text-indigo-800/80 leading-relaxed">{{ $targetCompany->mission }}</p>
                            </div>
                        @endif

                        @if($targetCompany->vision)
                            <div
                                class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-8 border border-blue-100 shadow-sm">
                                <div
                                    class="w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-blue-200">
                                    <i class="fa-solid fa-eye text-xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-blue-900 mb-4">Our Vision</h3>
                                <p class="text-blue-800/80 leading-relaxed">{{ $targetCompany->vision }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- History Section -->
                    @if($targetCompany->history)
                        <style>
                            .timeline-wrapper {
                                position: relative;
                                padding-left: 2.5rem;
                            }

                            .timeline-wrapper::before {
                                content: '';
                                position: absolute;
                                left: 0.5rem;
                                top: 0;
                                bottom: 0;
                                width: 2px;
                                background: linear-gradient(to bottom, #4f46e5 0%, #06b6d4 100%);
                                border-radius: 1px;
                                opacity: 0.2;
                            }

                            .timeline-item {
                                position: relative;
                                margin-bottom: 1rem;
                            }

                            .timeline-item::before {
                                content: '';
                                position: absolute;
                                left: -2.4rem;
                                top: 0.5rem;
                                width: 1.25rem;
                                height: 1.25rem;
                                background: white;
                                border: 3px solid #4f46e5;
                                border-radius: 50%;
                                z-index: 10;
                                box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.05);
                            }

                            .timeline-item:hover::before {
                                background: #4f46e5;
                                transform: scale(1.1);
                                transition: all 0.3s ease;
                            }

                            .timeline-card-glass {
                                background: #ffffff;
                                border: 1px solid #f3f4f6;
                                border-radius: 1rem;
                                padding: 0.75rem 1.25rem;
                                transition: all 0.3s ease;
                                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
                            }

                            .timeline-item:hover .timeline-card-glass {
                                transform: translateX(8px);
                                border-color: #4f46e5;
                                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                            }
                        </style>
                        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                            <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center">
                                <span class="w-1.5 h-7 bg-indigo-600 rounded-full mr-4"></span>
                                Our Journey & History
                            </h2>
                            <div class="timeline-wrapper">
                                @php
                                    $historyContent = strip_tags($targetCompany->history, '<p><br>');
                                    // Use regex to split by years (e.g., 2005, 2010) if they are used as headers
                                    // This regex looks for a 4-digit year starting with 19 or 20 followed by some space/dash/colon
                                    $historyItems = preg_split('/(?=\b(19|20)\d{2}\s*[-–:])/', $historyContent, -1, PREG_SPLIT_NO_EMPTY);

                                    // If regex split didn't yield multiple items, fallback to newline split
                                    if (count($historyItems) <= 1) {
                                        $historyItems = array_filter(explode("\n", str_replace(["\r\n", "\r"], "\n", $historyContent)));
                                    }
                                @endphp

                                @foreach($historyItems as $item)
                                    @php
                                        $item = trim(strip_tags($item));
                                        if (empty($item))
                                            continue;

                                        // Try to separate year from description
                                        $parts = preg_split('/\s*[-–:]\s*/', $item, 2);
                                        $year = count($parts) > 1 ? trim($parts[0]) : '';
                                        $desc = count($parts) > 1 ? trim($parts[1]) : $item;
                                    @endphp
                                    <div class="timeline-item">
                                        <div class="timeline-card-glass">
                                            @if($year)
                                                <div class="flex items-center gap-2 mb-2">
                                                    <span
                                                        class="px-3 py-1 bg-indigo-100 text-indigo-700 text-sm font-bold rounded-lg uppercase tracking-wider">
                                                        {{ $year }}
                                                    </span>
                                                    <div class="h-px bg-indigo-100 flex-grow"></div>
                                                </div>
                                            @endif
                                            <p class="text-gray-600 leading-relaxed font-medium">
                                                {{ $desc }}
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Contact Info Card -->
                    <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Contact Details</h3>
                        <div class="space-y-6">
                            @if($targetCompany->email)
                                <div class="flex items-start">
                                    <div
                                        class="w-10 h-10 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600 mr-4 shrink-0">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wider mb-1">Email Address
                                        </p>
                                        <a href="mailto:{{ $targetCompany->email }}"
                                            class="text-gray-900 font-medium hover:text-indigo-600 transition-colors">{{ $targetCompany->email }}</a>
                                    </div>
                                </div>
                            @endif

                            @if($targetCompany->phone)
                                <div class="flex items-start">
                                    <div
                                        class="w-10 h-10 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600 mr-4 shrink-0">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wider mb-1">Phone Number
                                        </p>
                                        <a href="tel:{{ $targetCompany->phone }}"
                                            class="text-gray-900 font-medium hover:text-indigo-600 transition-colors">{{ $targetCompany->phone }}</a>
                                    </div>
                                </div>
                            @endif

                            @if($targetCompany->address)
                                <div class="flex items-start">
                                    <div
                                        class="w-10 h-10 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600 mr-4 shrink-0">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wider mb-1">Office Address
                                        </p>
                                        <p class="text-gray-900 font-medium">{{ $targetCompany->address }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Navigation Card -->
                    <div class="bg-indigo-900 rounded-2xl shadow-xl p-8 text-white">
                        <h3 class="text-xl font-bold mb-6">Quick Actions</h3>
                        <div class="space-y-4">
                            <a href="{{ route('frontend.companies') }}"
                                class="flex items-center justify-between p-4 bg-white/10 rounded-xl hover:bg-white/20 transition-all border border-white/5 group">
                                <span>All Companies</span>
                                <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                            </a>
                            <a href="{{ route('frontend.contact') }}"
                                class="flex items-center justify-between p-4 bg-white/10 rounded-xl hover:bg-white/20 transition-all border border-white/5 group">
                                <span>Get in Touch</span>
                                <i class="fas fa-paper-plane transform group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection