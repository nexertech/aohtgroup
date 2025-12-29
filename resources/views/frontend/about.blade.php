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
                            <img src="{{ \Illuminate\Support\Str::startsWith($company->about_image, ['http', 'https']) ? $company->about_image : asset('storage/' . $company->about_image) }}" alt="About Us"
                                class="rounded-lg shadow-md w-full h-auto object-cover">
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

            @if($company->mission || $company->vision)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    @if($company->mission)
                        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-indigo-500">
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Our Mission</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $company->mission }}</p>
                        </div>
                    @endif
                    @if($company->vision)
                        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-cyan-500">
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Our Vision</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $company->vision }}</p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- History Timeline Section -->
            @if($company->history)
                <style>
                    .timeline-container {
                        position: relative;
                        padding-left: 3rem;
                        margin-top: 2rem;
                    }
                    .timeline-container::before {
                        content: '';
                        position: absolute;
                        left: 0.75rem;
                        top: 0;
                        bottom: 0;
                        width: 2px;
                        background: linear-gradient(to bottom, #7c3aed, #06b6d4);
                        border-radius: 1px;
                        opacity: 0.3;
                    }
                    .timeline-event {
                        position: relative;
                        margin-bottom: 2.5rem;
                    }
                    .timeline-dot {
                        position: absolute;
                        left: -2.25rem;
                        top: 0.25rem;
                        width: 1.5rem;
                        height: 1.5rem;
                        background: white;
                        border: 3px solid #7c3aed;
                        border-radius: 50%;
                        z-index: 10;
                        box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
                        transition: all 0.3s ease;
                    }
                    .timeline-event:hover .timeline-dot {
                        transform: scale(1.2);
                        background: #7c3aed;
                    }
                    .timeline-card {
                        background: white;
                        padding: 1.5rem;
                        border-radius: 1rem;
                        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
                        border: 1px solid #f3f4f6;
                        transition: all 0.3s ease;
                    }
                    .timeline-event:hover .timeline-card {
                        border-color: #7c3aed;
                        transform: translateX(8px);
                    }
                </style>
                <div class="mb-20">
                    <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Our Journey & History</h2>
                    <div class="max-w-4xl mx-auto">
                        <div class="timeline-container">
                            @php
                                $historyContent = strip_tags($company->history, '<p><br>');
                                // Splitting by year using regex
                                $historyItems = preg_split('/(?=\b(19|20)\d{2}\s*[-–:])/', $historyContent, -1, PREG_SPLIT_NO_EMPTY);
                                
                                if(count($historyItems) <= 1) {
                                    $historyItems = array_filter(explode("\n", str_replace(["\r\n", "\r"], "\n", $historyContent)));
                                }
                            @endphp
                            
                            @foreach($historyItems as $item)
                                @php
                                    $item = trim(strip_tags($item));
                                    if(empty($item)) continue;
                                    
                                    $parts = preg_split('/\s*[-–:]\s*/', $item, 2);
                                    $year = count($parts) > 1 ? trim($parts[0]) : '';
                                    $desc = count($parts) > 1 ? trim($parts[1]) : $item;
                                @endphp
                                <div class="timeline-event">
                                    <div class="timeline-dot"></div>
                                    <div class="timeline-card">
                                        @if($year)
                                            <div class="text-indigo-600 font-bold text-xs uppercase tracking-widest mb-2 flex items-center gap-2">
                                                <span class="px-2 py-0.5 bg-indigo-50 rounded">{{ $year }}</span>
                                                <div class="h-px bg-indigo-100 flex-grow"></div>
                                            </div>
                                        @endif
                                        <div class="text-gray-700 leading-relaxed font-medium text-sm md:text-base">{{ $desc }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Team Section -->
            @if($teamMembers->count() > 0)
                <div class="mb-12">
                    <h2 class="text-3xl font-bold text-center text-gray-900 mb-8 team-section-header" id="team">Meet Our Team</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($teamMembers as $member)
                            <div
                                class="team-card-about bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105 cursor-pointer"
                                style="{{ $loop->index >= 4 ? 'display: none;' : '' }}"
                                onclick="openTeamModal('{{ $member->name }}', '{{ $member->position }}', '{{ $member->photo ? asset('storage/' . $member->photo) : '' }}', '{{ e(strip_tags($member->bio)) }}', '{{ $member->facebook }}', '{{ $member->linkedin }}', '{{ $member->instagram }}')">
                                <div class="h-64 bg-gray-200 overflow-hidden">
                                    @if($member->photo)
                                        <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}"
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

                    @if($teamMembers->count() > 4)
                        <div class="text-center mt-12">
                            <button id="toggleTeamAboutBtn"
                                class="inline-flex items-center justify-center px-8 py-3 bg-indigo-600 text-white font-bold rounded-full hover:bg-indigo-700 transition duration-300 shadow-lg hover:shadow-indigo-200">
                                Show More Team
                            </button>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                const toggleBtn = document.getElementById('toggleTeamAboutBtn');
                                const items = document.querySelectorAll('.team-card-about');

                                if (toggleBtn) {
                                    toggleBtn.addEventListener('click', function () {
                                        const isShowingAll = this.innerText === 'Show Less Team';

                                        if (isShowingAll) {
                                            items.forEach((el, index) => {
                                                if (index >= 4) el.style.display = 'none';
                                            });
                                            this.innerText = 'Show More Team';
                                            // Optional: scroll to team header
                                            document.querySelector('.team-section-header').scrollIntoView({ behavior: 'smooth' });
                                        } else {
                                            items.forEach(el => el.style.display = '');
                                            this.innerText = 'Show Less Team';
                                        }
                                    });
                                }
                            });
                        </script>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <!-- Team Member Modal -->
    <div id="teamModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity"
            style="backdrop-filter: blur(8px); -webkit-backdrop-filter: blur(8px);" onclick="closeTeamModal()"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-xl">

                <div class="bg-indigo-600 px-4 py-4 sm:px-6 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-white" id="modal-team-name">Member Name</h3>
                    <button type="button" class="text-white hover:text-gray-200 focus:outline-none" onclick="closeTeamModal()">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="px-6 py-6 max-h-[70vh] overflow-y-auto">
                    <div class="flex flex-col items-center mb-6">
                        <div id="modal-team-image-container"
                            class="h-32 w-32 rounded-full overflow-hidden border-4 border-white shadow-lg mb-4">
                            <img id="modal-team-image" src="" alt="Team Member" class="w-full h-full object-cover hidden">
                            <div id="modal-team-placeholder"
                                class="w-full h-full bg-indigo-100 flex items-center justify-center text-4xl font-bold text-indigo-500 hidden">
                                <span id="modal-team-initials"></span>
                            </div>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900" id="modal-team-name-display"></h2>
                        <p class="text-indigo-600 font-medium" id="modal-team-designation"></p>

                        <div class="flex space-x-4 mt-4" id="modal-team-socials">
                            <a id="modal-team-facebook" href="#" target="_blank" class="text-gray-400 hover:text-blue-600 hidden">
                                <i class="fab fa-facebook fa-lg"></i>
                            </a>
                            <a id="modal-team-linkedin" href="#" target="_blank" class="text-gray-400 hover:text-blue-700 hidden">
                                <i class="fab fa-linkedin fa-lg"></i>
                            </a>
                            <a id="modal-team-instagram" href="#" target="_blank" class="text-gray-400 hover:text-pink-600 hidden">
                                <i class="fab fa-instagram fa-lg"></i>
                            </a>
                        </div>
                    </div>

                    <div class="prose max-w-none text-gray-600 text-center">
                        <p id="modal-team-bio"></p>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-4 flex justify-end">
                    <button type="button"
                        class="inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:text-sm"
                        onclick="closeTeamModal()">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openTeamModal(name, designation, photo, bio, facebook, linkedin, instagram) {
            document.getElementById('modal-team-name').innerText = name;
            document.getElementById('modal-team-name-display').innerText = name;
            document.getElementById('modal-team-designation').innerText = designation;

            const img = document.getElementById('modal-team-image');
            const placeholder = document.getElementById('modal-team-placeholder');
            const initials = document.getElementById('modal-team-initials');

            if (photo) {
                img.src = photo;
                img.classList.remove('hidden');
                placeholder.classList.add('hidden');
            } else {
                img.classList.add('hidden');
                placeholder.classList.remove('hidden');
                initials.innerText = name.charAt(0).toUpperCase();
            }

            document.getElementById('modal-team-bio').innerText = bio || 'No biography available.';

            const fbLink = document.getElementById('modal-team-facebook');
            if (facebook) { fbLink.href = facebook; fbLink.classList.remove('hidden'); } else { fbLink.classList.add('hidden'); }

            const liLink = document.getElementById('modal-team-linkedin');
            if (linkedin) { liLink.href = linkedin; liLink.classList.remove('hidden'); } else { liLink.classList.add('hidden'); }

            const instaLink = document.getElementById('modal-team-instagram');
            if (instagram) { instaLink.href = instagram; instaLink.classList.remove('hidden'); } else { instaLink.classList.add('hidden'); }

            document.getElementById('teamModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeTeamModal() {
            document.getElementById('teamModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
@endsection