<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="bg-gray-100">

<div id="left-nav-menu" class="left-nav">
    <ul>
        <li><a href="#league-of-legends">
            <img src="{{ asset('pictures/lol_icon.webp') }}" alt="LoL">League of Legends</a></li>
        <li><a href="#teamfight-tactics">
            <img src="{{ asset('pictures/tft_icon.webp') }}" alt="TFT">Teamfight Tactics</a></li>
        <li><a href="#valorant">
            <img src="{{ asset('pictures/valorant_icon.webp') }}" alt="Valorant">Valorant</a></li>
        <li><a href="#world-of-warcraft">
            <img src="{{ asset('pictures/wow_icon.webp') }}" alt="WoW">World of Warcraft</a></li>
    </ul>
</div>

<div class="navbar">

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

    <div id="middle-logoandtext" class="middle-content-search flex flex-col items-center justify-center mt-20 px-4">
        <img src="{{ asset('pictures/logowithtext.webp') }}" alt="metasrc" class="w-full">
        <div id="middle-text" class="flex-1 flex items-center">Statistical Builds, Guides & Tier Lists</div>
        <input type="text" class="p-2 text-lg rounded-md w-1/3 bg-white text-black" placeholder="Search for a guide...">
    </div>

    <section class="p-8 bg-white">
    <div class="section-boxes">
        <!-- Box 1 -->
        <div id="league-of-legends" class="p-6 bg-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow bg-cover bg-center"
            style="background-image: url('{{ asset('backgrounds/bg-summoners-rift.webp') }}');">
        <div class="flex items-center justify-between mb-4">  
            <div class="icon-container mr-4">
                <img src="{{ asset('pictures/lol_icon.webp') }}" alt="Icon 1" class="h-12 w-12 rounded-full icon-normal hover:icon-hover">
            </div>
            <div class="icon-container">
                <img src="{{ asset('pictures/lol_logo_flat.webp') }}" alt="Icon 2" class="h-12 w-12 rounded-full icon-normal hover:icon-hover">
            </div>
        </div>

            <div class="flex items-center mb-2 flex-row">
                <a href="/league/ranked">
                    <img src="{{ asset('pictures/5v5_icon.webp') }}" alt="Ranked Icon" class="h-6 w-6 mr-2">
                    <p class="under-text text-white">Ranked</p>
                </a>
            </div>
            <div class="flex items-center mb-2 flex-row">
                <a href="/league/aram">
                    <img src="{{ asset('pictures/aram_icon.webp') }}" alt="ARAM Icon" class="h-6 w-6 mr-2">
                    <p class="under-text text-white">ARAM</p>
                </a>
            </div>
            <div class="flex items-center mb-2 flex-row">
                <a href="/league/arena">
                    <img src="{{ asset('pictures/arena_icon.webp') }}" alt="Arena Icon" class="h-6 w-6 mr-2">
                    <p class="under-text text-white">Arena</p>
                </a>
            </div>
            <div class="flex items-center flex-row">
                <a href="/league/swiftplay">
                    <img src="{{ asset('pictures/5v5_icon.webp') }}" alt="Swiftplay Icon" class="h-6 w-6 mr-2">
                    <p class="under-text text-white">Swiftplay</p>
                </a>
            </div>
        </div>

        <!-- Box 2 -->
        <div id="teamfight-tactics" class="p-6 bg-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow bg-cover bg-center"
            style="background-image: url('{{ asset('backgrounds/bg-tft-galaxies.webp') }}');">
            <h3 class="text-xl font-semibold mb-4 text-white">Teamfight Tactics</h3>
            <div class="flex items-center mb-2 flex-row">
                <img src="{{ asset('pictures/tftmode_icon.webp') }}" alt="Ranked Icon" class="h-6 w-6 mr-2">
                <p class="under-text text-white">Ranked</p>
            </div>
            <div class="flex items-center mb-2 flex-row">
                <img src="{{ asset('pictures/hyper_icon.webp') }}" alt="Hyper Roll Icon" class="h-6 w-6 mr-2">
                <p class="under-text text-white">Hyper Roll</p>
            </div>
            <div class="flex items-center mb-2 flex-row">
                <img src="{{ asset('pictures/double_icon.webp') }}" alt="Double Up Icon" class="h-6 w-6 mr-2">
                <p class="under-text text-white">Double Up</p>
            </div>
            <div class="flex items-center flex-row">
                <img src="{{ asset('pictures/special_active_icon.webp') }}" alt="Tocker's Trials Icon" class="h-6 w-6 mr-2">
                <p class="under-text text-white">Tocker's Trials</p>
            </div>
        </div>

        <!-- Box 3 -->
        <div id="valorant" class="p-6 bg-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow bg-cover bg-center"
            style="background-image: url('{{ asset('backgrounds/bg-valorant.webp') }}');">
            <h3 class="text-xl font-semibold mb-4 text-white">Valorant</h3>
            <div class="flex items-center mb-2 flex-row">
                <img src="{{ asset('pictures/standard_icon.webp') }}" alt="Ranked Icon" class="h-6 w-6 mr-2">
                <p class="under-text text-white">Ranked</p>
            </div>
            <div class="flex items-center flex-row">
                <img src="{{ asset('pictures/spike_icon.webp') }}" alt="Spike Rush Icon" class="h-6 w-6 mr-2">
                <p class="under-text text-white">Spike Rush</p>
            </div>
        </div>

        <!-- Box 4 -->
        <div id="world-of-warcraft" class="p-6 bg-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow bg-cover bg-center"
            style="background-image: url('{{ asset('backgrounds/bg-wow.webp') }}');">
            <h3 class="text-xl font-semibold mb-4 text-white">World of Warcraft</h3>
            <div class="flex items-center mb-2 flex-row">
                <img src="{{ asset('pictures/all_roles.svg') }}" alt="Class Guides Icon" class="h-6 w-6 mr-2">
                <p class="under-text text-white">Class Guides</p>
            </div>
            <div class="flex items-center mb-2 flex-row">
                <img src="{{ asset('pictures/nav_tierlist.webp') }}" alt="Tier Lists Icon" class="h-6 w-6 mr-2">
                <p class="under-text text-white">Tier Lists</p>
            </div>
            <div class="flex items-center mb-2 flex-row">
                <img src="{{ asset('pictures/nav_stats.webp') }}" alt="Stats Icon" class="h-6 w-6 mr-2">
                <p class="under-text text-white">Stats</p>
            </div>
            <div class="flex items-center flex-row">
                <img src="{{ asset('pictures/nav_builder.webp') }}" alt="Talent Calculator Icon" class="h-6 w-6 mr-2">
                <p class="under-text text-white">Talent Calculator</p>
            </div>
        </div>
    </div>
</section>

<footer class="footer bg-gray-900 text-gray-300 py-6">
    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 text-center sm:text-left">
        <!-- League of Legends Section -->
        <div class="footer-section">
            <h3 class="text-lg font-semibold text-yellow-500 mb-3 flex items-center">
                <img src="pictures/lol_icon.webp" alt="League of Legends" class="h-6 w-6 mr-2">
                League of Legends
            </h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-white">Ranked</a></li>
                <li><a href="#" class="hover:text-white">ARAM</a></li>
                <li><a href="#" class="hover:text-white">Arena</a></li>
                <li><a href="#" class="hover:text-white">Swiftplay</a></li>
                <li><a href="#" class="hover:text-white">Ultimate Spellbook</a></li>
            </ul>
        </div>

        <!-- Teamfight Tactics Section -->
        <div class="footer-section">
            <h3 class="text-lg font-semibold text-yellow-500 mb-3 flex items-center">
                <img src="pictures/tft_icon.webp" alt="Teamfight Tactics" class="h-6 w-6 mr-2">
                Teamfight Tactics
            </h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-white">Ranked</a></li>
                <li><a href="#" class="hover:text-white">Hyper Roll</a></li>
                <li><a href="#" class="hover:text-white">Double Up</a></li>
                <li><a href="#" class="hover:text-white">Tocker's Trials</a></li>
            </ul>
        </div>

        <!-- Valorant Section -->
        <div class="footer-section">
            <h3 class="text-lg font-semibold text-yellow-500 mb-3 flex items-center">
                <img src="pictures/valorant_icon.webp" alt="Valorant" class="h-6 w-6 mr-2">
                Valorant
            </h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-white">Ranked</a></li>
                <li><a href="#" class="hover:text-white">Spike Rush</a></li>
            </ul>
        </div>

        <!-- World of Warcraft Section -->
        <div class="footer-section">
            <h3 class="text-lg font-semibold text-yellow-500 mb-3 flex items-center">
                <img src="pictures/wow_icon.webp" alt="World of Warcraft" class="h-6 w-6 mr-2">
                World of Warcraft
            </h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-white">Class Guides</a></li>
                <li><a href="#" class="hover:text-white">Tier Lists</a></li>
                <li><a href="#" class="hover:text-white">Stats</a></li>
                <li><a href="#" class="hover:text-white">Talent Calculator</a></li>
            </ul>
        </div>
    </div>
    <div class="container mx-auto text-right mt-4">
        <img src="{{ asset('pictures/logowithtext.webp') }}" alt="metasrc" class="footer-logo">
    </div>
</footer>

</body>

</html>

<style>
    .navbar {
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
        background-color: #111111;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1001;
        height: 70px;
    }
    .navbar input {
        background-color: white;
        color: black;
        }
    .navbar img {
        height: 40px;
        cursor: pointer;
        }

    body {
        margin: 0;
        background-color: #252525;
        }
    .nav-text-meta {
        color: #FBAF17;
        cursor: pointer;
        box-sizing: border-box;
        font-weight: bold;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        }
    .nav-text-src {
        color: white;
        cursor: pointer;
        box-sizing: border-box;
        font-weight: bold;
        font-family: Verdana, Arial, Helvetica, sans-serif;
        }
    .middle-content-search {
        margin-top: 60px;
        }
    .middle-content-search img {
        height: 150px;
        cursor: pointer;
        }
    .section-boxes {
            display: flex;
            grid-template-columns: repeat(4, 1fr); 
            gap: 1rem; 
            max-width: 100%;
            overflow-x: auto; 
            margin:auto;
            gap: 10rem;
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
        #league-of-legends {
            border: 4px solid rgb(93, 77, 59); 
            box-sizing: border-box;
            text-align: center;
        }
        .icon-container {
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease, filter 0.3s ease;
            cursor: pointer;
            margin: 0;
        }

        .icon-normal {
            transition: filter 0.3s ease, transform 0.3s ease;
            filter: grayscale(100%);
            width: 48px; 
            height: 48px;
            border-radius: 50%;
        }

        .icon-hover {
            filter: grayscale(0%);
            transform: scale(1.1);
        }
        .icon-normal:hover {
            filter: grayscale(0%);
            transform: scale(1.1);
        }
        .icon-container:hover .icon-normal {
            filter: grayscale(0%);
            transform: scale(1.1);
        }   

        #league-of-legends:hover .icon-container .icon-normal {
            filter: grayscale(0%);
            transform: scale(1.1);
        }

        #league-of-legends:hover .icon-container:nth-child(1) .icon-normal {
            filter: brightness(1.5);
        }

        #league-of-legends:hover .icon-container:nth-child(2) .icon-normal {
            filter: brightness(1.5);
        }
        #teamfight-tactics {
            border: 4px solid rgb(68, 77, 120); 
            box-sizing: border-box;
            text-align: center;
        }
        #valorant {
            border: 4px solid rgb(106, 38, 50); 
            box-sizing: border-box;
            text-align: center;
        }
        #world-of-warcraft {
            border: 4px solid rgb(130, 120, 105); 
            box-sizing: border-box;
            text-align: center;
        }
        .under-text {
            color: white;
            cursor: pointer;
            transition: color 0.3s ease;
            font-size: 1.3em !important;
            font-family: Verdana, Arial, Helvetica, sans-serif;
        }
        .under-text:hover {
            color: #FBAF17;
        }
        #middle-logoandtext {
            margin: 95px;
            text-align: center;
            width: 100%; 
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        #middle-text {
            color: white;
            margin-bottom: 20px;
        }
        img.h-6.w-6.mr-2 {
            width: 42px;
            height: 42px;
            margin-right: 8px;
        }
        .flex-row {
            display: flex;
            flex-direction: row;
            align-items: center;
        }
        a {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }
        .footer {
            background-color: #353535; 
            color: #aaa; 
            padding: 1.5rem 0; 
        }

        .footer h3 {
            color: #FBAF17; 
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .footer ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer ul li {
            margin-bottom: 0.5rem;
        }

        .footer ul li a {
            color: #FBAF17; 
            text-decoration: none;
            transition: color 0.2s ease;
            font-family: Verdana, Arial, Helvetica, sans-serif;
        }

        .footer ul li a:hover {
            color: #FBAF17; 
            text-decoration: underline;
        }

        .footer img {
            height: 1.5rem;
            width: 1.5rem;
            margin-right: 0.5rem;
        }
        .footer .container {
            display: flex;
            flex-direction: row; 
            gap: 20rem; 
        }
        .footer-logo {
            display:flex;
            height: 150px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .footer .container {
                grid-template-columns: 1fr; 
            }
        }
        
        .left-nav {
            position: fixed;
            top: 70px;
            left: 0px; 
            width: 60px;
            height: 100vh;
            background-color: #111111;
            transition: left 0.3s ease, width 0.3s ease;
            z-index: 1000;
        }

        .left-nav:hover {
            width: 200px;
            background-color: #111111;
        }

        .left-nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .left-nav ul li {
            padding: 20px;
            text-align: left;
        }

        .left-nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            opacity: 0;
            transition: opacity 0.3s ease, transform 0.3s ease;
            transform: translateX(-50px);
            padding-left: 10px;
            display: flex;
            white-space: nowrap;
        }

        .left-nav:hover ul li a {
            opacity: 1;
            transform: translateX(0);
        }

        .left-nav ul li a:hover {
            color: #FBAF17;
        }
        .left-nav ul li a img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
            opacity: 0.8;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .left-nav ul li a img:hover {
            transform: scale(1.2);
            opacity: 1;
        }

       
</style>

