<aside class="w-64 bg-gray-900 text-white min-h-screen flex flex-col font-sans border-r border-gray-800">
    <div class="h-20 flex items-center justify-center border-b border-gray-800 px-4">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center">
            <img src="{{ asset('images/logo/logo.png') }}" alt="A One Home Textile Group"
                class="h-12 w-auto object-contain">
        </a>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2">
        <!-- Dashboard Link -->
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center px-4 py-3 text-white hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800 text-white' : '' }}">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>

        <!-- Users Link -->
        <a href="{{ route('admin.users.index') }}"
            class="flex items-center px-4 py-3 text-white hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-gray-800 text-white' : '' }}">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            Users
        </a>

        <!-- Roles Link -->
        <a href="{{ route('admin.roles.index') }}"
            class="flex items-center px-4 py-3 text-white hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.roles.*') ? 'bg-gray-800 text-white' : '' }}">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            Roles
        </a>

        <!-- Company Info Link -->
        <a href="{{ route('admin.company-info.index') }}"
            class="flex items-center px-4 py-3 text-white hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.company-info.*') ? 'bg-gray-800 text-white' : '' }}">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
            Company Info
        </a>

        <!-- Team Members Link -->
        <a href="{{ route('admin.team-members.index') }}"
            class="flex items-center px-4 py-3 text-white hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.team-members.*') ? 'bg-gray-800 text-white' : '' }}">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            Team Members
        </a>

        <!-- Services Link -->
        <a href="{{ route('admin.services.index') }}"
            class="flex items-center px-4 py-3 text-white hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.services.*') ? 'bg-gray-800 text-white' : '' }}">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
            </svg>
            Services
        </a>

        <!-- Products with Sub-menu -->
        <div
            x-data="{ open: {{ request()->routeIs('admin.product-categories.*') || request()->routeIs('admin.product-galleries.*') ? 'true' : 'false' }} }">
            <div class="flex items-center">
                <a href="{{ route('admin.products.index') }}"
                    class="flex-1 flex items-center px-4 py-3 text-white hover:bg-gray-800 hover:text-white rounded-l-lg transition-colors duration-200 {{ request()->routeIs('admin.products.*') ? 'bg-gray-800 text-white' : '' }}">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>Products</span>
                </a>
                <button @click="open = !open"
                    class="px-3 py-3 text-white hover:bg-gray-800 rounded-r-lg transition-colors duration-200 {{ request()->routeIs('admin.product-categories.*') || request()->routeIs('admin.product-galleries.*') ? 'bg-gray-800' : '' }}">
                    <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>
            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95" class="ml-8 mt-2 space-y-1">
                <a href="{{ route('admin.product-categories.index') }}"
                    class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.product-categories.*') ? 'bg-gray-800 text-white' : '' }}">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    Product Categories
                </a>
                <a href="{{ route('admin.product-galleries.index') }}"
                    class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.product-galleries.*') ? 'bg-gray-800 text-white' : '' }}">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Product Gallery
                </a>
            </div>
        </div>

        <!-- Blogs Link -->
        <a href="{{ route('admin.blogs.index') }}"
            class="flex items-center px-4 py-3 text-white hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.blogs.*') ? 'bg-gray-800 text-white' : '' }}">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
            Blogs
        </a>

        <!-- Sliders Link -->
        <a href="{{ route('admin.sliders.index') }}"
            class="flex items-center px-4 py-3 text-white hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.sliders.*') ? 'bg-gray-800 text-white' : '' }}">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Sliders
        </a>

        <!-- Pages with Sub-menu -->
        <div
            x-data="{ open: {{ request()->routeIs('admin.contact-messages.*') || request()->routeIs('admin.job-openings.*') || request()->routeIs('admin.job-applications.*') || request()->routeIs('admin.email-templates.*') || request()->routeIs('admin.activity-logs.*') || request()->routeIs('admin.error-logs.*') || request()->routeIs('admin.visitors.*') ? 'true' : 'false' }} }">
            <div class="flex items-center">
                <a href="#" @click.prevent="open = !open"
                    class="flex-1 flex items-center px-4 py-3 text-white hover:bg-gray-800 hover:text-white rounded-l-lg transition-colors duration-200 {{ request()->routeIs('admin.contact-messages.*') || request()->routeIs('admin.job-openings.*') || request()->routeIs('admin.job-applications.*') || request()->routeIs('admin.email-templates.*') || request()->routeIs('admin.activity-logs.*') || request()->routeIs('admin.error-logs.*') || request()->routeIs('admin.visitors.*') ? 'bg-gray-800 text-white' : '' }}">
                    <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Pages</span>
                </a>
                <button @click="open = !open"
                    class="px-3 py-3 text-white hover:bg-gray-800 rounded-r-lg transition-colors duration-200 {{ request()->routeIs('admin.contact-messages.*') || request()->routeIs('admin.job-openings.*') || request()->routeIs('admin.job-applications.*') || request()->routeIs('admin.email-templates.*') || request()->routeIs('admin.activity-logs.*') || request()->routeIs('admin.error-logs.*') || request()->routeIs('admin.visitors.*') ? 'bg-gray-800' : '' }}"
                    :class="{ 'bg-gray-800': open }">
                    <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>
            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95" class="ml-8 mt-2 space-y-1">

                <!-- Sub Links -->
                <a href="#"
                    class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    About Us
                </a>
                <a href="#"
                    class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    Contact Us
                </a>
                <a href="#"
                    class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Privacy Policy
                </a>

                <!-- Contact Messages Link -->
                <a href="{{ route('admin.contact-messages.index') }}"
                    class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.contact-messages.*') ? 'bg-gray-800 text-white' : '' }}">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Contact Messages
                </a>

                <!-- Job Openings Link -->
                <a href="{{ route('admin.job-openings.index') }}"
                    class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.job-openings.*') ? 'bg-gray-800 text-white' : '' }}">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Job Openings
                </a>

                <!-- Job Applications Link -->
                <a href="{{ route('admin.job-applications.index') }}"
                    class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.job-applications.*') ? 'bg-gray-800 text-white' : '' }}">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Job Applications
                </a>

                <!-- Email Templates Link -->
                <a href="{{ route('admin.email-templates.index') }}"
                    class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.email-templates.*') ? 'bg-gray-800 text-white' : '' }}">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Email Templates
                </a>

                <!-- Activity Logs Link -->
                <a href="{{ route('admin.activity-logs.index') }}"
                    class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.activity-logs.*') ? 'bg-gray-800 text-white' : '' }}">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Activity Logs
                </a>

                <!-- Error Logs Link -->
                <a href="{{ route('admin.error-logs.index') }}"
                    class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.error-logs.*') ? 'bg-gray-800 text-white' : '' }}">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Error Logs
                </a>

                <!-- Visitors Link -->
                <a href="{{ route('admin.visitors.index') }}"
                    class="flex items-center px-4 py-2 text-sm text-gray-300 hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.visitors.*') ? 'bg-gray-800 text-white' : '' }}">
                    <svg class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Visitors
                </a>
            </div>
        </div>

        <a href="#"
            class="flex items-center px-4 py-3 text-white hover:bg-gray-800 hover:text-white rounded-lg transition-colors duration-200">
            <svg class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Settings
        </a>
    </nav>
    <!-- Activity Details Modal (same as activity logs) -->
    <div id="viewActivityModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-slate-900/60 transition-opacity backdrop-blur-sm"></div>
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-white" id="modal-title">Activity Details</h3>
                    <button type="button" class="text-white/80 hover:text-white focus:outline-none transition-colors"
                        onclick="closeActivityModal()">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="px-6 py-6">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-5 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-slate-500 mb-1">User</dt>
                            <dd class="text-sm font-semibold text-slate-900" id="modalActivityUser">--</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-slate-500 mb-1">IP Address</dt>
                            <dd class="text-sm font-mono text-slate-900 bg-slate-100 px-2 py-1 rounded inline-block"
                                id="modalActivityIP">--</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-slate-500 mb-1">Action</dt>
                            <dd class="text-sm text-slate-900" id="modalActivityAction">--</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-slate-500 mb-1">Description</dt>
                            <dd class="text-sm text-slate-900 break-words" id="modalActivityDescription">--</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-slate-500 mb-1">Time</dt>
                            <dd class="text-sm text-slate-900" id="modalActivityTime">--</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openActivityModal(activity) {
            document.getElementById('modalActivityUser').innerText = activity.user ? activity.user.name : 'System';
            document.getElementById('modalActivityIP').innerText = activity.ip_address || 'N/A';
            document.getElementById('modalActivityAction').innerText = activity.action;
            document.getElementById('modalActivityDescription').innerText = activity.description || 'No description';
            document.getElementById('modalActivityTime').innerText = new Date(activity.created_at).toLocaleString();
            document.getElementById('viewActivityModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            document.querySelector('#viewActivityModal .backdrop-blur-sm').addEventListener('click', closeActivityModal);
        }
        function closeActivityModal() {
            document.getElementById('viewActivityModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
</aside>