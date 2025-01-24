<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>League of Legends - Ranked</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
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
    }
    .navbar input {
        background-color: #333;
        color: white;
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
</style>