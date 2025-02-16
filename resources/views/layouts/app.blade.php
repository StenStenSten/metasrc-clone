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

    <!-- Stylesheets -->
    @vite(['resources/css/app.css', 'resources/css/components/navbar.css', 'resources/css/components/footer.css'])
</head>
<body>
    <div class="left-nav">
        <!-- Left Navbar -->
        @include('partials.left-navbar')

        <!-- Main Content Area -->
        <div class="navbar">
            <!-- Navbar (Top) -->
            @include('partials.navbar')

            <!-- Page Heading -->
            @isset($header)
                <header class="page-header">
                    <div class="header-container">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('content') <!-- Yield the content section here -->
            </main>
        </div>
    </div>

    <!-- Footer -->
    @include('partials.footer')
</body>
</html>
