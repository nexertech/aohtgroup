@extends('frontend.layouts.app')

@section('content')
    <div class="bg-gray-100 py-12">
            <div class="container-custom">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-6 text-center">Our Company</h1>
                <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Proudly working with leading organizations
                    globally.</p>

                @if($companies->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($companies as $comp)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 flex flex-col h-full border border-gray-100">
                                <div class="p-6 flex flex-col items-center flex-grow">
                                    <div class="w-24 h-24 mb-6 relative">
                                        @if($comp->logo)
                                            <img src="{{ \Illuminate\Support\Str::startsWith($comp->logo, ['http', 'https']) ? $comp->logo : asset('storage/' . $comp->logo) }}" 
                                                 alt="{{ $comp->company_name }}"
                                                 class="w-full h-full object-contain drop-shadow-sm transform hover:scale-105 transition-transform duration-300">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center text-2xl font-bold text-gray-400">
                                                {{ substr($comp->company_name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>

                                    <h3 class="text-xl font-bold text-gray-900 text-center mb-2">{{ $comp->company_name }}</h3>

                                    @if($comp->tagline)
                                        <p class="text-sm text-indigo-600 font-medium text-center mb-4">{{ $comp->tagline }}</p>
                                    @endif

                                    <div class="w-full space-y-3 mt-2 mb-6">
                                        @if($comp->email)
                                            <div class="flex items-center text-sm text-gray-600 justify-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                <a href="mailto:{{ $comp->email }}" class="hover:text-indigo-600 transition-colors">{{ $comp->email }}</a>
                                            </div>
                                        @endif

                                        @if($comp->phone)
                                            <div class="flex items-center text-sm text-gray-600 justify-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                <a href="tel:{{ $comp->phone }}" class="hover:text-indigo-600 transition-colors">{{ $comp->phone }}</a>
                                            </div>
                                        @endif

                                        @if($comp->address)
                                            <div class="flex items-start text-sm text-gray-600 justify-center text-center">
                                                <svg class="w-4 h-4 mr-2 text-gray-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                <span>{{ \Illuminate\Support\Str::limit($comp->address, 50) }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="mt-auto pt-4 w-full border-t border-gray-100">
                                        <button onclick="openCompanyModal({{ $comp->id }})" class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 transition-colors duration-200 font-medium text-sm">
                                            View Full Profile
                                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                        </button>
                                    </div>
                                </div>

                                <!-- Hidden Data for Modal -->
                                <div id="company-data-{{ $comp->id }}" class="hidden">
                                    <div class="data-name">{{ $comp->company_name }}</div>
                                    <div class="data-tagline">{{ $comp->tagline }}</div>
                                    <div class="data-about">{!! $comp->about !!}</div>
                                    <div class="data-mission">{!! $comp->mission !!}</div>
                                    <div class="data-vision">{!! $comp->vision !!}</div>
                                    <div class="data-history">{!! $comp->history !!}</div>
                                    <div class="data-logo">{{ \Illuminate\Support\Str::startsWith($comp->logo, ['http', 'https']) ? $comp->logo : asset('storage/' . $comp->logo) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Company Detail Modal -->
                    <div id="companyModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm" onclick="closeCompanyModal()"></div>

                        <div class="flex min-h-full items-center justify-center p-4 sm:p-0">
                            <div class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl border border-gray-200">

                                <!-- Header with BG -->
                                <div class="bg-gradient-to-r from-indigo-600 to-blue-600 px-6 py-6 sm:px-10 flex justify-between items-start">
                                    <div class="flex items-center">
                                        <img id="modalLogo" src="" alt="Logo" class="h-16 w-16 bg-white rounded-lg p-1 object-contain shadow-md mr-5">
                                        <div>
                                            <h3 class="text-2xl font-bold text-white" id="modalCompanyName"></h3>
                                            <p class="text-indigo-100 text-sm mt-1" id="modalTagline"></p>
                                        </div>
                                    </div>
                                    <button type="button" class="text-white hover:text-gray-200 focus:outline-none bg-white/10 hover:bg-white/20 rounded-full p-2 transition-colors" onclick="closeCompanyModal()">
                                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>

                                <!-- Content -->
                                <div class="px-6 py-8 sm:px-10 max-h-[70vh] overflow-y-auto">
                                    <div class="grid grid-cols-1 gap-12">
                                        <!-- About Section -->
                                        <div id="modalAboutSection">
                                            <h4 class="text-lg font-bold text-gray-900 border-b pb-2 mb-4 flex items-center">
                                                <span class="bg-indigo-100 text-indigo-700 p-1.5 rounded mr-3">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                </span>
                                                About Us
                                            </h4>
                                            <div id="modalAbout" class="prose prose-indigo text-gray-600"></div>
                                        </div>

                                        <!-- Mission & Vision -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                            <div id="modalMissionSection" class="bg-blue-50 p-6 rounded-xl border border-blue-100">
                                                <h4 class="text-lg font-bold text-blue-900 mb-3 flex items-center">
                                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                                    Our Mission
                                                </h4>
                                                <div id="modalMission" class="text-blue-800 text-sm leading-relaxed"></div>
                                            </div>
                                            <div id="modalVisionSection" class="bg-purple-50 p-6 rounded-xl border border-purple-100">
                                                <h4 class="text-lg font-bold text-purple-900 mb-3 flex items-center">
                                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                                    Our Vision
                                                </h4>
                                                <div id="modalVision" class="text-purple-800 text-sm leading-relaxed"></div>
                                            </div>
                                        </div>

                                        <!-- History Section -->
                                        <div id="modalHistorySection">
                                            <h4 class="text-lg font-bold text-gray-900 border-b pb-2 mb-4 flex items-center">
                                                <span class="bg-amber-100 text-amber-700 p-1.5 rounded mr-3">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                </span>
                                                Our History
                                            </h4>
                                            <div id="modalHistory" class="prose prose-indigo text-gray-600"></div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="bg-gray-50 px-6 py-4 sm:px-10 flex justify-end gap-3 rounded-b-2xl">
                                    <button type="button" class="w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-5 py-2.5 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm transition-colors" onclick="closeCompanyModal()">Closing</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <script>
                        function openCompanyModal(id) {
                            const container = document.getElementById('company-data-' + id);
                            if(!container) return;

                            document.getElementById('modalCompanyName').innerText = container.querySelector('.data-name').innerText;

                            const tagline = container.querySelector('.data-tagline').innerText;
                            document.getElementById('modalTagline').innerText = tagline;
                            document.getElementById('modalTagline').style.display = tagline ? 'block' : 'none';

                            const logoSrc = container.querySelector('.data-logo').innerText;
                            document.getElementById('modalLogo').src = logoSrc;

                            const about = container.querySelector('.data-about').innerHTML;
                            document.getElementById('modalAbout').innerHTML = about || '<p class=\"text-gray-400 italic\">No description available.</p>';

                            const mission = container.querySelector('.data-mission').innerHTML;
                            document.getElementById('modalMission').innerHTML = mission || 'N/A';
                            document.getElementById('modalMissionSection').style.display = mission ? 'block' : 'none';

                            const vision = container.querySelector('.data-vision').innerHTML;
                            document.getElementById('modalVision').innerHTML = vision || 'N/A';
                            document.getElementById('modalVisionSection').style.display = vision ? 'block' : 'none';

                            const history = container.querySelector('.data-history').innerHTML;
                            document.getElementById('modalHistory').innerHTML = history || 'N/A';
                            document.getElementById('modalHistorySection').style.display = history ? 'block' : 'none';

                            const modal = document.getElementById('companyModal');
                            modal.classList.remove('hidden');
                            // Prevent body scroll
                            document.body.style.overflow = 'hidden';
                        }

                        function closeCompanyModal() {
                            const modal = document.getElementById('companyModal');
                            modal.classList.add('hidden');
                            document.body.style.overflow = 'auto';
                        }
                    </script>
                @else
                    <div class="text-center py-20 text-gray-500">
                        <p>No companies listed at the moment.</p>
                    </div>
                @endif
            </div>
        </div>
@endsection