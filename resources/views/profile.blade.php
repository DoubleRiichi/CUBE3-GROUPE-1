@extends('layouts.mainlayout')

@section('content')
<link rel="stylesheet" href="{{ asset("css/profil.css")}}">
<div id="content">
    <p>Profil de {{ $user->name }}</p>
    <p>Email : {{ $user->email }}</p>
    <p>right : {{ $user->right }}</p>
    <p>avatar : <img src="{{ asset($user->avatar) }}" alt="Avatar" width="100"></p>
    <p>badge : {{ $user->badge }}</p>

    @if (Auth::check() && Auth::user()->name == $user->name)
        <a href="{{route('profile.edit', ['name' => $user->name]) }}">Modifier les informations du Profil</a>
    @endif
    
</div>  
@endsection