@extends('layouts.mainlayout')
@section ('title', 'Recherche')
@section("content")

<link rel="stylesheet" href="{{asset("css/search.css")}}">

<div class=" mt-4  row" id="search-area">
    <div class="col-12 bg-light col-md-6 m-auto">
        <form class="inline-form" id="search-form" method="POST" action="/search/">
            @csrf

            <label class="form-label" for="title">Titre : </label>
            <input class="form-control" type="text" name="title" id="" size="50">
            <label class="form-label" for="beforeDate">Avant : </label>
            <input class="form-control" type="date" name="beforeDate" id="">
            <label class="form-label" for="afterDate">Après : </label>
            <input class="form-control" type="date" name="afterDate" id="">
            <label class="form-label" for="minimumRating">Note : </label>
            <input class="form-control" type="text" name="minimumRating" id="" size="1">
            <label class="form-label" for="minimumPopularity">Popularité : </label>
            <input class="form-control" type="text" name="minimumPopularity" size="1">
            <label class="form-label" for="minimumBudget">Budget : </label>
            <input class="form-control" type="text" name="minimumBudget" id="" size="1">
            <button class="btn bluebtn ml-5 mt-3" type="submit">Chercher</button>
        </form>
    </div>
    @if(isset($results))
    <div class="row ">
        <div id="" class=" mx-auto  p-4 bg-light col-12 col-md-6 mt-5 table-responsive">
            <table class="table table-striped table-hover table-bordered">
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
