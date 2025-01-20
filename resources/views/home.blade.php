<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="navbar flex items-center justify-between p-4 bg-white text-black fixed w-full top-0 left-0 z-10">

        <div class="flex-1 text-right">
            <input type="text" class="p-2 text-lg rounded-md w-1/3 bg-gray-700 text-white" placeholder="Search for a guide...">
        </div>
        
        <div class="flex-1 flex items-center justify-center">
          <a href="{{ url('/')}}">
            <img src="{{ asset(path: 'pictures/mainlogo.webp') }}" alt="Logo" class="h-8 inline-block">
            <b class="nav-text-meta">META</b><b class="nav-text-src">src</b>
          </a>
        </div>

        <div class="flex-1"></div>
    </div>

    <div class="middle-content-search flex flex-col items-center justify-center mt-20 px-4">
        <img src="{{ asset('pictures/logowithtext.webp') }}" alt="metasrc" class="w-full">
        <div class="flex-1 flex items-center">Statistical Builds, Guides & Tier Lists</div>
        <input type="text" class="p-2 text-lg rounded-md w-1/3 bg-white text-black" placeholder="Search for a guide...">
    </div>

    <section class="p-8 bg-white">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-screen-lg mx-auto">
        <!-- Box 1 -->
        <div id="league-of-legends" class="p-6 bg-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow bg-cover bg-center"
            style="background-image: url('{{ asset('backgrounds/bg-summoners-rift.webp') }}');">
            <h3 class="text-xl font-semibold mb-4 text-white">League of Legends</h3>
            <div class="flex items-center mb-2">
                <img src="{{ asset('pictures/5v5_icon.webp') }}" alt="Ranked Icon" class="h-6 w-6 mr-2">
                <p class="text-white">Ranked</p>
            </div>
            <div class="flex items-center mb-2">
                <img src="{{ asset('pictures/aram_icon.webp') }}" alt="ARAM Icon" class="h-6 w-6 mr-2">
                <p class="text-white">ARAM</p>
            </div>
            <div class="flex items-center mb-2">
                <img src="{{ asset('pictures/arena_icon.webp') }}" alt="Arena Icon" class="h-6 w-6 mr-2">
                <p class="text-white">Arena</p>
            </div>
            <div class="flex items-center">
                <img src="{{ asset('pictures/5v5_icon.webp') }}" alt="Swiftplay Icon" class="h-6 w-6 mr-2">
                <p class="text-white">Swiftplay</p>
            </div>
        </div>

        <!-- Box 2 -->
        <div id="teamfight-tactics" class="p-6 bg-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow bg-cover bg-center"
            style="background-image: url('{{ asset('backgrounds/bg-tft-galaxies.webp') }}');">
            <h3 class="text-xl font-semibold mb-4 text-white">Teamfight Tactics</h3>
            <div class="flex items-center mb-2">
                <img src="{{ asset('pictures/tftmode_icon.webp') }}" alt="Ranked Icon" class="h-6 w-6 mr-2">
                <p class="text-white">Ranked</p>
            </div>
            <div class="flex items-center mb-2">
                <img src="{{ asset('pictures/hyper_icon.webp') }}" alt="Hyper Roll Icon" class="h-6 w-6 mr-2">
                <p class="text-white">Hyper Roll</p>
            </div>
            <div class="flex items-center mb-2">
                <img src="{{ asset('pictures/double_icon.webp') }}" alt="Double Up Icon" class="h-6 w-6 mr-2">
                <p class="text-white">Double Up</p>
            </div>
            <div class="flex items-center">
                <img src="{{ asset('pictures/special_active_icon.webp') }}" alt="Tocker's Trials Icon" class="h-6 w-6 mr-2">
                <p class="text-white">Tocker's Trials</p>
            </div>
        </div>

        <!-- Box 3 -->
        <div id="valorant" class="p-6 bg-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow bg-cover bg-center"
            style="background-image: url('{{ asset('backgrounds/bg-valorant.webp') }}');">
            <h3 class="text-xl font-semibold mb-4 text-white">Valorant</h3>
            <div class="flex items-center mb-2">
                <img src="{{ asset('pictures/standard_icon.webp') }}" alt="Ranked Icon" class="h-6 w-6 mr-2">
                <p class="text-white">Ranked</p>
            </div>
            <div class="flex items-center">
                <img src="{{ asset('pictures/spike_icon.webp') }}" alt="Spike Rush Icon" class="h-6 w-6 mr-2">
                <p class="text-white">Spike Rush</p>
            </div>
        </div>

        <!-- Box 4 -->
        <div id="world-of-warcraft" class="p-6 bg-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow bg-cover bg-center"
            style="background-image: url('{{ asset('backgrounds/bg-wow.webp') }}');">
            <h3 class="text-xl font-semibold mb-4 text-white">World of Warcraft</h3>
            <div class="flex items-center mb-2">
                <img src="{{ asset('pictures/all_roles.svg') }}" alt="Class Guides Icon" class="h-6 w-6 mr-2">
                <p class="text-white">Class Guides</p>
            </div>
            <div class="flex items-center mb-2">
                <img src="{{ asset('pictures/nav_tierlist.webp') }}" alt="Tier Lists Icon" class="h-6 w-6 mr-2">
                <p class="text-white">Tier Lists</p>
            </div>
            <div class="flex items-center mb-2">
                <img src="{{ asset('pictures/nav_stats.webp') }}" alt="Stats Icon" class="h-6 w-6 mr-2">
                <p class="text-white">Stats</p>
            </div>
            <div class="flex items-center">
                <img src="{{ asset('pictures/nav_builder.webp') }}" alt="Talent Calculator Icon" class="h-6 w-6 mr-2">
                <p class="text-white">Talent Calculator</p>
            </div>
        </div>
    </div>
</section>



</body>

</html>

<style>
    .navbar {
        height: 60px;
    }

    .navbar input {
        background-color: #333;
        color: white;
    }

    .navbar h1 {
        color: white;
    }

    .navbar img {
        height: 40px;
        cursor: pointer;
    }

    body {
         
    }
    .nav-text-meta {
        color: #FBAF17;
        cursor: pointer;
        box-sizing: border-box;
        font-weight: bold;
    }
    .nav-text-src {
        color: white;
        cursor: pointer;
        box-sizing: border-box;
        font-weight: bold;
    }
    .middle-content-search {
        margin-top: 60px;
    }
    .middle-content-search img {
        height: 150px;
        cursor: pointer;
    }
    .section-boxes {
            display: grid;
            grid-template-columns: repeat(4, 1fr); 
            gap: 1rem; 
            max-width: 100%;
            overflow-x: auto; 
        }

        .section-box {
            background-size: cover;
            background-position: center;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            flex-shrink: 0;
            width: 100%;
            min-height: 200px;
        }

        .section-box:hover {
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: white;
        }

        .section-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
            color: white;
            cursor: pointer;
        }

        .section-item img {
            height: 1.5rem;
            width: 1.5rem;
            margin-right: 0.5rem;
            cursor: pointer;
        }
        .grid {
    overflow-x: auto;
        }
        a {
            text-decoration: none;
        }
        #league-of-legends {
            border: 4px solid rgb(93, 77, 59); 
            box-sizing: border-box;
        }
        #teamfight-tactics {
            border: 4px solid rgb(68, 77, 120); 
            box-sizing: border-box;
        }
        #valorant {
            border: 4px solid rgb(106, 38, 50); 
            box-sizing: border-box;
        }
        #world-of-warcraft {
            border: 4px solid rgb(130, 120, 105); 
            box-sizing: border-box;
        }

</style>
