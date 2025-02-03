<?php
$api_url = "https://ddragon.leagueoflegends.com/cdn/12.6.1/data/en_US/champion.json";

// Fetch the JSON data
$json_data = file_get_contents($api_url);

// Decode the JSON data into an associative array
$champion_data = json_decode($json_data, true);

// Check if data is retrieved successfully
if ($champion_data && isset($champion_data['data'])) {
    $champions = $champion_data['data']; // Array containing all champions
} else {
    echo "Error fetching champion data.";
}
?>

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
            <input type="text" class="p-2 text-lg rounded-md w-1/3 bg-gray-700 text-white"
                placeholder="Search for a guide...">
        </div>

        <div class="flex-1 flex items-center justify-center">
            <a href="{{ url('/')}}">
                <img src="{{ asset(path: 'pictures/mainlogo.webp') }}" alt="Logo" class="h-8 inline-block">
                <b class="nav-text-meta">META</b><b class="nav-text-src">src</b>
            </a>
        </div>

        <div class="flex-1"></div>

    </div>
        <div class="champion-grid-container">
            <div class="champion-grid">
                <?php
    // Loop through all champions and display their names and images
    foreach ($champions as $champion) {
    $champion_name = $champion['id']; // Champion's name
    $champion_image = "https://ddragon.leagueoflegends.com/cdn/12.6.1/img/champion/{$champion_name}.png"; // Champion's image URL
    echo "
        <div class='champion-box'>
            <img src='{$champion_image}' alt='{$champion_name}'>
            <div class='champion-name'>{$champion_name}</div>
        </div>";
    }
    ?>
            </div>
        </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const championBoxes = document.querySelectorAll('.champion-box');

            championBoxes.forEach((box) => {
                box.addEventListener('mouseenter', () => {
                    championBoxes.forEach((otherBox) => {
                        if (otherBox !== box) {
                            otherBox.classList.add('inactive');
                        } else {
                            otherBox.classList.remove('inactive');
                        }
                    });
                });

                box.addEventListener('mouseleave', () => {
                    championBoxes.forEach((otherBox) => {
                        otherBox.classList.remove('inactive');
                    });
                });
            });
        });
    </script>
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
        position: relative;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 100;
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
        overflow-x: hidden;
        background-image: url('/backgrounds/bg-summoners-rift.webp'); 
        background-attachment: fixed;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover; 
        width: 100vw;  
        height: 100vh;
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

    .champion-grid-container {
        margin-top: 80px;
        padding: 20px;
        box-sizing: border-box;
    }

    .champion-grid {
        display: grid;
        min-width: 375px;
        max-width: 1200px;
        width: 100%;
        flex-direction: column;
        gap: 10px;
        padding: 20px;
        justify-content: center;
        margin: 0 auto;
        grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)); 
    }

    .champion-box {
        text-align: center;
        padding: 5px;
        border: 1px solid #ccc;
        background-color: #333;
        width: 80px;
        height: 80px;
        transition: background-color 0.3s ease, transform 0.3s ease;
        cursor: pointer;
    }

    .champion-box img {
        width: 60px;
        height: 60px;
        object-fit: contain;
    }

    .champion-name {
        margin-top: 5px;
        font-size: 12px;
        color: white;
        font-family: Verdana, Arial, Helvetica, sans-serif;
    }

    .champion-box:hover {
        background-color: #FBAF17;
        transform: scale(1.05);
    }

    .champion-box:hover~.champion-box {
        background-color: #555;
    }

    .champion-grid .champion-box:not(:hover) {
        background-color: #333;
    }

    .champion-box:hover img {
        filter: grayscale(0);
    }

    .champion-box img.grayscale {
        filter: grayscale(100%);
    }

    .champion-box.inactive img {
        filter: grayscale(100%);
    }

    @media (max-width: 1024px) {
        .champion-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 768px) {
        .champion-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 480px) {
        .champion-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>