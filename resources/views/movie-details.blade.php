@extends('layouts.mainlayout')
<!-- USE JOIN TABLE -->
@section("content")

<link rel="stylesheet" href="{{ asset("css/movie-details.css")}}">

    <div id="movie-details">

      <div id="up">
      @if ($movie->poster_path)
        <img class="movie-poster" src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" alt="{{ stripslashes($movie->title) }} poster">
      @else
          <br> <!-- Show a stock picture instead -->
      @endif
        <h2>{{ stripslashes($movie->title) }}  <span> {{ stripslashes($movie->original_title) }}</span></h2>
      @if ($movie->tagline)
        <p>{{stripslashes($movie->tagline)}}</p>
      @endif
      @if ($movie->overview)
        <p>{{stripslashes($movie->overview)}}</p>
      @endif
      </div>
      <div id="bottom">
        <p>{{$movie->original_language}}</p>
        <p>{{$movie->release_date}}</p>
        <p>{{$movie->status}}</p>
        <p>{{$movie->homepage}}</p>
        <p>{{$movie->runtime}}</p>
        <p>{{$movie->budget}}</p>
        <p>{{$movie->popularity}}</p>
      </div>
    </div>


    <div id="comments-list">
      <h2>Comments</h2>
      
      @if (!empty($comments))
        @foreach ($comments as $comment)
          <div class="comment">
            <div class="user-info">
              <p class="username"> {{$comment->username}} </p>
              <p class=""> {{$comment->user_created_at}} </p>
              <img src="" alt="avatar">
              <p>{{$comment->badge}}</p>
            </div>
            <div class="user-comment">
              <p> {{$comment->created_at}}</p>
              <p>{{$comment->updated_at}}</p>
              <p class="text">{{$comment->content}}</p>
              <!-- add a signature ? -->
              
            </div>
          </div>
        @endforeach
      @else
          <p class="no-comment">Be the first to comment!</p>
      @endif
    </div>
@endsection