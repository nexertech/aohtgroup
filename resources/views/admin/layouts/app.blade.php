<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        @include('admin.layouts.partials.sidebar')

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Navbar -->
            @include('admin.layouts.partials.navbar')

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
                @isset($header)
                    <!-- Optional Header for breadcrumbs or page titles if passed -->
                    <div class="mb-6">
                        {{ $header }}
                    </div>
                @endisset

                <div class="max-w-7xl mx-auto">
                    {{ $slot ?? '' }}
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            @include('admin.layouts.partials.footer')
        </div>
    </div>
</body>

</html>