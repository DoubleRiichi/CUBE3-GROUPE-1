<?php 
       use App\Models\Movie; ?>
@extends('layouts.mainlayout')

@section('content')
<link rel="stylesheet" href="{{ asset("css/profil.css")}}">
<div class="mainbox" id="profil">
    <p>Profil de {{ $user->name }}</p>
    <p>Email : {{ $user->email }}</p>
    <p>right : {{ $user->permissions }}</p>
    <p>avatar : <img src="{{ asset($user->avatar) }}" alt="Avatar" width="100"></p>
    <p>badge : {{ $user->badge }}</p>

    @if (Auth::check() && Auth::user()->name == $user->name)
    <a href="{{route('profile.edit', ['name' => $user->name]) }}">Modifier les informations du Profil</a>
    @endif


    @if (Auth::check() && Auth::user()->permissions == "admin")
        <button class="redbtn" id="show-comment-form">Bannir</button>

        <form id="comment-form" method="POST" action="/admin/ban" hidden>
            @csrf
            <input type="text" name="id" id="" value="{{$user->id}}" hidden>
            <label for="description">Raison : </label>
            <textarea name="description" id="content" cols="100" rows="10"></textarea>
            <br>
            <button class="redbtn" type="submit">confirmer</button>
        </form>
    @endif
</div>

@if (!empty($comments))
<div class="mainbox" id="comments">
    @foreach ($comments as $comment)
    <div class="commentbox">
        <?php $movie = Movie::byId($comment->movie_id) ?>
        <div class="comment-header">
            <a href="/movie/{{$movie->id}}">{{$movie->title}}</a>
            <div class="comment-date">
                <span>Edited: {{$comment->updated_at}}</span>
                <span>Posted: {{$comment->created_at}}</span>
            </div>
        </div>
        <p>{{html_entity_decode($comment->content)}}</p>
        <!-- add a signature ? -->

    </div>
    @endforeach
</div>
@endif
<script src="{{asset("js/movieDetails.js")}}"></script>

@endsection
