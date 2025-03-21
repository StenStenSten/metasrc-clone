
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    @vite(['resources/css/app.css', 'resources/css/pages/home.css'])
</head>

<body>

@extends('layouts.app')

@section('title', 'Home Page')

@section('navbar')

@section('left-navbar')
  
@endsection

@section('content')
    <div class="middle-logoandtext">
        <img src="{{ asset('pictures/logowithtext.webp') }}" alt="metasrc" class="middle-logo">
        <div class="middle-text">Statistical Builds, Guides & Tier Lists</div>
        <input type="text" placeholder="Search for a guide...">
    </div>

    <section class="section-container">
        <div class="section-boxes grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            
            <!-- Box 1: League of Legends -->
            <div id="league-of-legends" class="section-box">
                <div class="icon-row">
                    <div class="icon-container">
                        <img src="{{ asset('pictures/lol_icon.webp') }}" alt="Icon 1" class="icon-normal">
                    </div>
                    <div class="icon-container">
                        <img src="{{ asset('pictures/lol_logo_flat.webp') }}" alt="Icon 2" class="icon-normal">
                    </div>
                </div>
                <div class="section-item">
                    <a href="/league/ranked" class="flex items-center">
                        <img src="{{ asset('pictures/5v5_icon.webp') }}" alt="Ranked Icon" class="icon-small">
                        <p class="under-text">Ranked</p>
                    </a>
                </div>
                <div class="section-item">
                    <a href="/league/aram" class="flex items-center">
                        <img src="{{ asset('pictures/aram_icon.webp') }}" alt="ARAM Icon" class="icon-small">
                        <p class="under-text">ARAM</p>
                    </a>
                </div>
                <div class="section-item">
                    <a href="/league/arena" class="flex items-center">
                        <img src="{{ asset('pictures/arena_icon.webp') }}" alt="Arena Icon" class="icon-small">
                        <p class="under-text">Arena</p>
                    </a>
                </div>
            </div>

            <!-- Box 2: Teamfight Tactics -->
            <div id="teamfight-tactics" class="section-box">
                <h3 class="section-title">Teamfight Tactics</h3>
                <div class="section-item">
                    <img src="{{ asset('pictures/tftmode_icon.webp') }}" alt="Ranked Icon" class="icon-small">
                    <p class="under-text">Ranked</p>
                </div>
                <div class="section-item">
                    <img src="{{ asset('pictures/hyper_icon.webp') }}" alt="Hyper Roll Icon" class="icon-small">
                    <p class="under-text">Hyper Roll</p>
                </div>
                <div class="section-item">
                    <img src="{{ asset('pictures/double_icon.webp') }}" alt="Double Up Icon" class="icon-small">
                    <p class="under-text">Double Up</p>
                </div>
                <div class="section-item">
                    <img src="{{ asset('pictures/special_active_icon.webp') }}" alt="Tocker's Trials Icon" class="icon-small">
                    <p class="under-text">Tocker's Trials</p>
                </div>
            </div>

            <!-- Box 3: Valorant -->
            <div id="valorant" class="section-box">
                <h3 class="section-title">Valorant</h3>
                <div class="section-item">
                    <a href="/valorant/valoranked" class="flex items-center">
                        <img src="{{ asset('pictures/standard_icon.webp') }}" alt="Ranked Icon" class="icon-small">
                        <p class="under-text">Ranked</p>
                    </a>
                </div>
                <div class="section-item">
                    <img src="{{ asset('pictures/spike_icon.webp') }}" alt="Spike Rush Icon" class="icon-small">
                    <p class="under-text">Spike Rush</p>
                </div>
            </div>

        </div>
    </section>

    @push('styles')
    <style>
        #league-of-legends {
            background-image: url("{{ asset('backgrounds/bg-summoners-rift.webp') }}");
        }
        #teamfight-tactics{
            background-image: url("{{ asset('backgrounds/bg-tft-galaxies.webp') }}");
        }
        #valorant{
            background-image: url("{{ asset('backgrounds/bg-valorant.webp') }}");
        }
    </style>
    @endpush
@endsection

</body>

</html>
