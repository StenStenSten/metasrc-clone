@extends('layouts.app')

@section('title', 'Champion: ' . ucfirst($championName) . ' - ' . ucfirst($gameMode))

@section('content')
    <div class="champion-details">
        <h1>{{ ucfirst($championName) }} - {{ ucfirst($gameMode) }}</h1>

        <div class="champion-build">
            <img src="{{ $championImage }}" alt="{{ $championName }} Image">
            
            <h3>Recommended Build for {{ ucfirst($gameMode) }}</h3>

            <div class="build-items">
                @foreach($buildItems as $item)
                    <div class="build-item">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                        <p>{{ $item['name'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/champion-show.css') }}">
@endpush
