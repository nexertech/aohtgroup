@extends('admin.layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 border-l-4 border-blue-600 pl-4 py-1">About Us Page Management</h1>
            <p class="mt-2 text-gray-600 pl-5">Manage your company profile, mission, vision, and team.</p>
        </div>

        <div class="grid grid-cols-1 gap-6">

            <!-- Quick Links Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Manage Sections
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="{{ route('admin.company-info.index') }}"
                        class="flex items-center p-4 bg-gray-50 hover:bg-gray-100 rounded-lg transition-colors border border-gray-200 hover:border-gray-300 group">
                        <div
                            class="h-10 w-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center mr-3 group-hover:bg-gray-600 group-hover:text-white transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900">Company Profile</div>
                            <div class="text-xs text-gray-500">Global Settings</div>
                        </div>
                    </a>

                    <a href="{{ route('admin.team-members.index') }}"
                        class="flex items-center p-4 bg-gray-50 hover:bg-teal-50 rounded-lg transition-colors border border-gray-200 hover:border-teal-200 group">
                        <div
                            class="h-10 w-10 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center mr-3 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900">Management Team</div>
                            <div class="text-xs text-gray-500">Dynamic Cards</div>
                        </div>
                    </a>

                    <a href="{{ route('admin.certificates.index') }}"
                        class="flex items-center p-4 bg-gray-50 hover:bg-yellow-50 rounded-lg transition-colors border border-gray-200 hover:border-yellow-200 group">
                        <div
                            class="h-10 w-10 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center mr-3 group-hover:bg-yellow-600 group-hover:text-white transition-colors">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <div class="font-medium text-gray-900">Certifications</div>
                            <div class="text-xs text-gray-500">Achievements</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Content Editing Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                    <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit About Page Content
                </h2>
                <form action="{{ route('admin.pages.about.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label for="mission" class="block text-sm font-semibold text-gray-700 mb-1">Our Mission</label>
                            <textarea name="mission" id="mission" rows="4"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150"
                                placeholder="Enter your mission statement...">{{ old('mission', $companyInfo->mission ?? '') }}</textarea>
                        </div>

                        <div>
                            <label for="vision" class="block text-sm font-semibold text-gray-700 mb-1">Our Vision</label>
                            <textarea name="vision" id="vision" rows="4"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150"
                                placeholder="Enter your vision statement...">{{ old('vision', $companyInfo->vision ?? '') }}</textarea>
                        </div>

                        <div>
                            <label for="history" class="block text-sm font-semibold text-gray-700 mb-1">History
                                Timeline</label>
                            <textarea name="history" id="history" rows="6"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150"
                                placeholder="Enter company history...">{{ old('history', $companyInfo->history ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection