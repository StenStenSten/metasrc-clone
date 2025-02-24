<head>
    <title>League of Legends - Ranked</title>
    @vite(['resources/css/app.css', 'resources/css/pages/ranked.css'])
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
                @if (!empty($champions))
                    @foreach ($champions as $champion)
                        @php
                            $champion_name = $champion['id'];
                            $champion_image = "https://ddragon.leagueoflegends.com/cdn/15.3.1/img/champion/{$champion['image']['full']}";
                        @endphp

                        <div class="champion-box">
                            <img src="{{ $champion_image }}" alt="{{ $champion_name }}">
                            <div class="champion-name">{{ $champion['name'] }}</div>
                        </div>
                    @endforeach
                @else
                    <p class="text-white text-center">No champions found.</p>
                @endif
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


