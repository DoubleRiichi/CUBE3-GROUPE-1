<?php 
       use App\Models\Movie; ?>
@extends('layouts.mainlayout')

@section('content')
<link rel="stylesheet" href="{{ asset("css/profil.css")}}">
<div id="content">
    <p>Profil de {{ $user->name }}</p>
    <p>Email : {{ $user->email }}</p>
    <p>right : {{ $user->permissions }}</p>
    <p>avatar : <img src="{{ asset($user->avatar) }}" alt="Avatar" width="100"></p>
    <p>badge : {{ $user->badge }}</p>

    @if (Auth::check() && Auth::user()->name == $user->name)
        <a href="{{route('profile.edit', ['name' => $user->name]) }}">Modifier les informations du Profil</a>
    @endif
    
</div>  

<link rel="stylesheet" href="{{ asset("css/comments-history.css")}}">
    @if (!empty($comments))
    <div id="comment-area">
        @foreach ($comments as $comment)
        <div class="comment">
            <?php $movie = Movie::byId($comment->movie_id) ?>
                <div class="movie-titles">
                <a href="/movie/{{$movie->id}}">{{$movie->title}}</a>
                    <span>Posted: {{$comment->created_at}}</span>
                    <span>Edited: {{$comment->updated_at}}</span>
                </div>
                <p class="comment-text">{{html_entity_decode($comment->content)}}</p>
                <!-- add a signature ? -->
                
            </div>
        @endforeach
        </div>
    @endif
@endsection