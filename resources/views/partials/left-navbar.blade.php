<div id="left-nav-menu" class="left-nav">
    <ul>
        <!-- League of Legends -->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle">
                <img src="{{ asset('pictures/lol_icon.webp') }}" alt="LoL"> League of Legends
                <span class="arrow">&#9662;</span> <!-- Downward arrow -->
            </a>
            <ul class="dropdown-menu">
                <li><a href="/league/ranked">
                    <img src="{{ asset('pictures/5v5_icon.webp') }}" alt="Ranked Icon"> Ranked
                </a></li>
                <li><a href="/league/aram">
                    <img src="{{ asset('pictures/aram_icon.webp') }}" alt="ARAM Icon"> ARAM
                </a></li>
                <li><a href="/league/arena">
                    <img src="{{ asset('pictures/arena_icon.webp') }}" alt="Arena Icon"> Arena
                </a></li>
                <li><a href="/league/swiftplay">
                    <img src="{{ asset('pictures/5v5_icon.webp') }}" alt="Swiftplay Icon"> Swiftplay
                </a></li>
            </ul>
        </li>

        <!-- Teamfight Tactics -->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle">
                <img src="{{ asset('pictures/tft_icon.webp') }}" alt="TFT"> Teamfight Tactics
                <span class="arrow">&#9662;</span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="#">
                    <img src="{{ asset('pictures/tftmode_icon.webp') }}" alt="Ranked Icon"> Ranked
                </a></li>
                <li><a href="#">
                    <img src="{{ asset('pictures/hyper_icon.webp') }}" alt="Hyper Roll Icon"> Hyper Roll
                </a></li>
                <li><a href="#">
                    <img src="{{ asset('pictures/double_icon.webp') }}" alt="Double Up Icon"> Double Up
                </a></li>
                <li><a href="#">
                    <img src="{{ asset('pictures/special_active_icon.webp') }}" alt="Tocker's Trials Icon"> Tocker's Trials
                </a></li>
            </ul>
        </li>

        <!-- Valorant -->
        <li class="dropdown">
            <a href="#" class="dropdown-toggle">
                <img src="{{ asset('pictures/valorant_icon.webp') }}" alt="Valorant"> Valorant
                <span class="arrow">&#9662;</span>
            </a>
            <ul class="dropdown-menu">
                <li><a href="/valorant/valoranked">
                    <img src="{{ asset('pictures/standard_icon.webp') }}" alt="Ranked Icon"> Ranked
                </a></li>
                <li><a href="#">
                    <img src="{{ asset('pictures/spike_icon.webp') }}" alt="Spike Rush Icon"> Spike Rush
                </a></li>
            </ul>
        </li>
    </ul>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const leftNav = document.getElementById("left-nav-menu");

    document.querySelectorAll('.dropdown-toggle').forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            let parent = this.closest(".dropdown");

            // Close all other dropdowns
            document.querySelectorAll('.dropdown').forEach(dropdown => {
                if (dropdown !== parent) {
                    dropdown.classList.remove("active");
                }
            });

            // Toggle this one
            parent.classList.toggle("active");
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener("click", function (event) {
        if (!event.target.closest(".left-nav")) {
            document.querySelectorAll(".dropdown").forEach(dropdown => {
                dropdown.classList.remove("active");
            });
        }
    });

    // Close dropdowns when mouse leaves left-navbar
    leftNav.addEventListener("mouseleave", function () {
        document.querySelectorAll(".dropdown").forEach(dropdown => {
            dropdown.classList.remove("active");
        });
    });
});


</script>
