@extends('layouts.mainlayout')

@section('title', 'Accueil')
@section('content')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<div class="mainbox">
    <div class="movie-list-container">
        <h1>Les films les plus populaires</h1>
        <div class="movie-list">
            @foreach ($mostPopularMovies as $movie)
            <div class="movie-item">
                @if($movie->poster_path)
                <a href="./movie/{{$movie->id}}">
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" alt="{{ $movie->title }} poster" class="movie-poster">
                </a>
                @else
                <p>No poster available</p>
                @endif
                <h3 class="movie-title"><a href="./movie/{{$movie->id}}">{{ stripslashes($movie->title) }}</a></h3>
            </div>
            @endforeach
        </div>
    </div>
    <div class="movie-list-container">
        <h1>Films actuellement à l'affiche</h1>
        <div class="movie-list">
            @foreach ($nowPlayingMovies as $movie)
            <div class="movie-item">
                @if($movie->poster_path)
                <a href="./movie/{{$movie->id}}">
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" alt="{{ $movie->title }} poster" class="movie-poster">
                </a>
                @else
                <p>No poster available</p>
                @endif
                <h3 class="movie-title"><a href="./movie/{{$movie->id}}">{{ stripslashes($movie->title) }}</a></h3>
            </div>
            @endforeach
        </div>
    </div>
    <div class="movie-list-container">
        <h1>Films à venir</h1>
        <div class="movie-list">
            @foreach ($upcomingMovies as $movie)
            <div class="movie-item">
                @if($movie->poster_path)
                <a href="./movie/{{$movie->id}}">
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" alt="{{ $movie->title }} poster" class="movie-poster">
                </a>
                @else
                <p>No poster available</p>
                @endif
                <h3 class="movie-title"><a href="./movie/{{$movie->id}}">{{ stripslashes($movie->title) }}</a></h3>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
