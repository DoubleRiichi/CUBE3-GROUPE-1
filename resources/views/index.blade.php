@extends('layouts.mainlayout')

@section('content')
<style>
        .movie-list {
            display: flex;
            flex-wrap: wrap; /* Empêche le passage à la ligne */
             /* Défilement horizontal si nécessaire */
            padding: 0;
            margin: 0;
            background-color: rgba(255, 255, 255, .7);
            border: 1em solid;
            justify-content: center;
        }
        .movie-item {
            flex: 0 0 auto; /* Permet aux éléments de se réduire si nécessaire */
            margin-right: 10px; /* Marge entre les éléments */
            text-align: center;
        }
        .movie-item:last-child {
            margin-right: 0; /* Pas de marge à droite pour le dernier élément */
        }
        .movie-item img {
            max-width: 70%;
            height: auto;
        }


    </style>
<div id="movie-container">
    <h1>Les films les plus populaires</h1>
    <div class="movie-list">
        @foreach ($mostPopularMovies as $movie)
            <div class="movie-item">
                <h3><a href="./movie/{{$movie->id}}">{{stripslashes($movie->title)}}</a></h3>
                @if($movie->poster_path)
                    <img src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" alt="{{ $movie->title }} poster">
                @else
                    <p>No poster available</p>
                @endif
            </div>
        @endforeach
    </div>
</div>

@endsection
