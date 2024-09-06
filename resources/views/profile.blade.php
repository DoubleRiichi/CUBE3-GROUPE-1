<?php 
       use App\Models\Movie; ?>
@extends('layouts.mainlayout')

@section('content')
<link rel="stylesheet" href="{{ asset("css/profil.css")}}">
<div class="row" id="profil">
    <div class="col col-md-4 mx-auto bg-light mt-4 p-3 text-center">

    <p class="fs-4 ">Profil de {{ $user->name }}</p>
    <div class="row">
        <div class="col-3">
            <div class="avatar-container">
                <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="avatar">
            </div>
        </div>
        <div class="col text-start">
            <p>{{ $user->email }}</p>
            <p>{{$comments->count()}} commentaires postés</p>
            <p>Inscrit le {{$user->created_at->format("d/m/Y à H:i:s")}}</p>
            <p>role {{$user->permissions}} </p>
        </div>
    </div>


    @if (Auth::check() && Auth::user()->name == $user->name)
    <a href="{{route('profile.edit', ['name' => $user->name]) }}">Modifier les informations du profil</a>
    @endif


    @if (Auth::check() && Auth::user()->permissions == "admin" && $user->id != Auth::id())
        <div class="row">
            <div class="col ">
                <button class="redbtn" id="show-comment-form">Bannir</button>

                <form id="comment-form" method="POST" action="/admin/ban" hidden>
                    @csrf
                    <input type="text" name="id" id="" value="{{$user->id}}" hidden>
                    <label for="description">Raison : </label>
                    <textarea name="description" id="content" cols="100" rows="10"></textarea>
                    <br>
                    <button class="redbtn" type="submit">confirmer</button>
                </form>
            </div>
        </div>

    @endif
    </div>
</div>

<div class="row" id="comments">
    <div class="col bg-light col-md-6 my-4 mx-auto p-3">
        <h2 class="fs-4 mb-2">Dernier Commentaires</h2>
@if ($comments->count())

    @foreach ($comments as $comment)
    <div class="row">
        <div class="col">
            <div class="commentbox ">
                <?php $movie = Movie::byId($comment->movie_id) ?>
                <div class="comment-header">
                    <a href="/movie/{{$movie->id}}">{{$movie->title}}</a>
                    <div class="comment-date me-2">
                        <span>Edited: {{$comment->updated_at->format("d-m-Y H:i:s")}}</span>
                        <span>Posted: {{$comment->created_at->format("d-m-Y H:i:s")}}</span>
                    </div>
                </div>
                <p>{{html_entity_decode($comment->content)}}</p>
                <!-- add a signature ? -->

            </div>
        </div>
    </div>
    @endforeach
@else
        <div class="" id="comments">
            <p>Pas de commentaires!</p>
        </div>
@endif
    </div>
</div>
<script src="{{asset("js/movieDetails.js")}}"></script>

@endsection
