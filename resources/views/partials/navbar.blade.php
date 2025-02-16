<div class="navbar">
    {{-- Search Bar --}}
    <div class="navbar__search">
        <input type="text" class="navbar__search-input" placeholder="Search for a guide...">
    </div>

    {{-- Logo & Home Link --}}
    <div class="navbar__logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('pictures/mainlogo.webp') }}" alt="Logo" class="navbar__logo-img">
            <b class="logo-text logo-text--yellow">META</b><b class="logo-text logo-text--red">src</b>
        </a>
    </div>

    {{-- Empty Div for Alignment --}}
    <div class="navbar__empty"></div>
</div>
