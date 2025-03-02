<footer class="footer">
    <div class="footer-container">
        <!-- League of Legends Section -->
        <div class="footer-section">
            <h3 class="footer-title">
                <img src="pictures/lol_icon.webp" alt="League of Legends" class="footer-icon">
                League of Legends
            </h3>
            <ul class="footer-list">
                <li><a href="/league/ranked"><img src="{{ asset('pictures/5v5_icon.webp') }}" alt="Ranked Icon" class="footer-icon">Ranked</a></li>
                <li><a href="#"><img src="{{ asset('pictures/aram_icon.webp') }}" alt="ARAM Icon" class="footer-icon">ARAM</a></li>
                <li><a href="#"><img src="{{ asset('pictures/arena_icon.webp') }}" alt="Arena Icon" class="footer-icon">Arena</a></li>
            </ul>
        </div>

        <!-- Teamfight Tactics Section -->
        <div class="footer-section">
            <h3 class="footer-title">
                <img src="pictures/tft_icon.webp" alt="Teamfight Tactics" class="footer-icon">
                Teamfight Tactics
            </h3>
            <ul class="footer-list">
                <li><a href="/tft/tftranked"><img src="{{ asset('pictures/tftmode_icon.webp') }}" alt="Ranked Icon" class="footer-icon">Ranked</a></li>
                <li><a href="#"><img src="{{ asset('pictures/hyper_icon.webp') }}" alt="Hyper Roll Icon" class="footer-icon">Hyper Roll</a></li>
                <li><a href="#"><img src="{{ asset('pictures/double_icon.webp') }}" alt="Double Up Icon" class="footer-icon">Double Up</a></li>
                <li><a href="#"><img src="{{ asset('pictures/special_active_icon.webp') }}" alt="Tocker's Trials Icon" class="footer-icon">Tocker's Trials</a></li>
            </ul>
        </div>

        <!-- Valorant Section -->
        <div class="footer-section">
            <h3 class="footer-title">
                <img src="pictures/valorant_icon.webp" alt="Valorant" class="footer-icon">
                Valorant
            </h3>
            <ul class="footer-list">
                <li><a href="{{ route('valorant.ranked') }}"><img src="{{ asset('pictures/standard_icon.webp') }}" alt="Ranked Icon" class="footer-icon">Ranked</a></li>
                <li><a href="#"><img src="{{ asset('pictures/spike_icon.webp') }}" alt="Spike Rush Icon" class="footer-icon">Spike Rush</a></li>
            </ul>
        </div>

       

    <div class="footer-section">
        <img src="{{ asset('pictures/logowithtext.webp') }}" alt="metasrc" class="footer-logo">
    </div>
</footer>
