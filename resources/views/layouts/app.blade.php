<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}?v=1" type="image/x-icon">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Stylesheets -->
    @vite(['resources/css/app.css', 'resources/css/components/navbar.css', 'resources/css/components/footer.css'])

    <!-- Add page-specific styles here -->
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!--<div class="left-nav">
            @include('partials.left-navbar') 
        --> 

        <!-- Navbar (Top) -->
        <div class="navbar">
            @include('partials.navbar')
        </div>

            <!-- Page Content -->
            <main>
                @yield('content') <!-- Yield the content section here -->
            </main>

        <!-- Footer -->
        @include('partials.footer')
    </div>

    <!-- Add page-specific scripts here -->
    @stack('scripts')
</body>
</html>
