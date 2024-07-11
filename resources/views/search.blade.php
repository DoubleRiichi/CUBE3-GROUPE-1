@extends('layouts.mainlayout')

@section("content")

<link rel="stylesheet" href="{{asset("css/search.css")}}">

<div class="mainbox" id="search-area">
    <form class="inline-form" id="search-form" method="POST" action="/search/">
        @csrf
        <div class="row">
            <label for="title">Titre : </label>
            <input type="text" name="title" id="" size="50"> 
        </div>
        <div class="row">
            <label for="beforeDate">Avant : </label>
            <input type="date" name="beforeDate" id=""> 
            <label for="afterDate">Après : </label>
            <input type="date" name="afterDate" id="">
        </div>
        <div class="row">
            <label for="minimumRating">Note : </label>
            <input type="text" name="minimumRating" id="" size="1">
            <label for="minimumPopularity">Popularité : </label>
            <input type="text" name="minimumPopularity" size="1">
            <label for="minimumBudget">Budget : </label>
            <input type="text" name="minimumBudget" id="" size="1">
        </div>
        <br>
        <button class="redbtn" type="submit">Chercher</button>
    </form>

    @if(isset($results))
    <div id="search-results">
        <table>
            <caption>
                Résultats
            </caption>
            <thead>
                <tr>
                <th scope="col">Titre</th>
                <th scope="col">Date de sortie</th>
                <th scope="col">Budget</th>
                <th scope="col">Popularité</th>
                <th scope="col">Note</th>
                @if ($current_user)
                    <th scope="col">Actions</th>
                @endif
                </tr>
            </thead>
            <tbody>
        @foreach ($results as $movie)
            <tr>
                <!-- TODO: dynamically fetch posters-->
                <th scope="row"><a class="movie-link" href="/movie/{{$movie->id}}">{{stripslashes($movie->title)}}
                    <span><img class="movie-poster" src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" height="150" alt="{{stripslashes($movie->title) }} poster"></span></a></th>
                <td>{{$movie->release_date}}</td>
                <td>{{$movie->budget}}</td>
                <td>{{$movie->popularity}}</td>
                <td>0</td>
                @if ($current_user)
                    <td><a href="">[ + ]</a></td>               
                @endif
            </tr>   
        @endforeach
            </tbody>
            <tfoot>
                <tr>
                <th scope="row" colspan="4">Nombre de Résultats</th>
                <td>{{count($results)}}</td>
                </tr>
            </tfoot>
        </table>

    </div>
    @endif
<br>
    @if ($errors->any())
    <div id="error-box">
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
</div>



<script src="{{asset("js/search.js")}}"></script>
@endsection