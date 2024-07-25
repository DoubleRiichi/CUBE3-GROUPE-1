@extends('layouts.mainlayout')
<!-- USE JOIN TABLE -->
@section("content")

<link rel="stylesheet" href="{{ asset("css/movie-details.css")}}">
<link rel="stylesheet" href="{{ asset("css/comments.css")}}">
@if ($errors->any())
<div id="error-box">
    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif
<div class="mainbox" id="movie">
    <h2>{{ stripslashes($movie->title) }} <span> {{ stripslashes($movie->original_title) }}</span></h2>
    <div class="movie-details">
        @if ($movie->poster_path)
        <img class="movie-poster" src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" alt="{{stripslashes($movie->title) }} poster">
        @else
        <br> <!-- Show a stock picture instead -->
        @endif
        <div id="recaps">
            @if ($movie->tagline)
            <p class="movie-box">{{stripslashes($movie->tagline)}}</p>
            @endif
            @if ($movie->overview)
            <p class="movie-box">{{stripslashes($movie->overview)}}</p>
            @endif

            <div class="movie-box" id="other-details">
                <p>Langue Originale : {{$movie->original_language}}</p>
                <p>Date de Sortie : {{$movie->release_date}}</p>
                <p>Status : {{$movie->status}}</p>
                <p>Page Officielle : <a href="{{$movie->homepage}}">{{$movie->homepage}}</a></p>
                <p>Durée : {{$movie->runtime}} minutes</p>
                <p>Budget : {{$movie->budget}}$</p>
                <p>Popularité : {{$movie->popularity}}</p>

                @if (Auth::check())
                <div id="add-list-area">
                    <button class="redbtn" id="add-list-btn">Ajouter</button>
                    <form hidden id="add-list-form" method="POST" action="/list/{{Auth::id()}}">
                        @csrf

                        <label for="status">Status : </label>
                        <select name="status" id="field-status">
                            <!-- ne pas changer -->
                            <option value="Vus">Vu</option>
                            <option value="À voir">À voir</option>
                        </select>
                        <label for="rating">Note : </label>
                        <input id="add-list-note" type="text" name="rating" id="field-rating" maxlength="4">
                        <input type="text" name="movie_id" hidden value="{{$movie->id}}">
                        <input type="text" name="user_id" hidden value="{{$current_user->id}}">

                        <button class="redbtn" id="inline-submit-btn" type="submit">Ajouter</button>
                    </form>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

<div class="mainbox">
    <h2>Commentaires</h2>
    <!--TODO: add a way to get the current login user ID, and check if they're connected -->
    @if($current_user)
    <button class="redbtn" id="show-comment-form">Commenter</button>

    <form id="comment-form" method="POST" action="/movie/{{$movie->id}}" hidden>
        @csrf
        <textarea name="content" id="content" cols="100" rows="10"></textarea>
        <br>
        <button class="redbtn" type="submit">Poster</button>
    </form>
    @endif

    @if (!empty($comments))
    @foreach ($comments as $comment)
    <div class="commentbox">
        <div class="box" id="user">
            <span> <a href="/profile/{{$comment->username}}">{{$comment->username}}</a></span>
            <span> {{substr($comment->user_created_at, 0, 10)}}</span>
            <img src="{{asset("storage/$comment->avatar")}}" alt="avatar">
            <span>{{$comment->badge}}</span>
        </div>
        <div class="box" id="comment">
            <div class="comment-date">
                <span>Edited: {{$comment->updated_at}}</span>
                <span>Posted: {{$comment->created_at}}</span>
            </div>
            <p class="comment-text">{{html_entity_decode($comment->content)}}</p>
            <!-- add a signature ? -->
        </div>
    </div>
    @endforeach
    @else
    <p class="no-comment">Be the first to comment!</p>
    @endif
</div>
@if($current_user)
<script src="{{asset("js/movieDetails.js")}}"></script>
@endif
@endsection
