@extends('layouts.mainlayout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<div class="mainbox">
    <h1>Les films les plus populaires</h1>
    <div class="movie-list">
        @foreach ($mostPopularMovies as $movie)
            <div class="movie-item">
                <h3><a href="./movie/{{$movie->id}}">{{stripslashes($movie->title)}}</a></h3>
                @if($movie->poster_path)
                <a href="./movie/{{$movie->id}}"><img src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" alt="{{ $movie->title }} poster"><a href=""></a>
                @else
                    <p>No poster available</p>
                @endif
            </div>
        @endforeach
    </div>
</div>

@endsection
