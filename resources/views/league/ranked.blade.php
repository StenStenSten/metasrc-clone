@extends('layouts.app')

@section('title', 'Ranked Page')

@push('styles')
    @vite('resources/css/pages/ranked.css') 
@endpush

@section('content')
    <div class="champion-grid-container">
        <div class="champion-grid">
            @if (!empty($champions))
                @foreach ($champions as $champion)
                    @php
                        $champion_name = $champion['id'];
                        $champion_image = "https://ddragon.leagueoflegends.com/cdn/15.3.1/img/champion/{$champion['image']['full']}";
                    @endphp

                    <!-- Make each champion box clickable -->
                    <a href="{{ route('champion.show', ['game_mode' => 'ranked', 'champion_name' => $champion_name]) }}" class="champion-box">
                        <img src="{{ $champion_image }}" alt="{{ $champion_name }}">
                        <div class="champion-name">{{ $champion['name'] }}</div>
                    </a>
                @endforeach
            @else
                <p class="text-white text-center">No champions found.</p>
            @endif
        </div>
    </div>
@endsection

<style>
    body {
        background-image: url('{{ asset('backgrounds/bg-summoners-rift.webp') }}');
    }
</style>

@push('scripts')
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
@endpush
