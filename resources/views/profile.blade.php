@extends('layouts.mainlayout')

@section('content')
<link rel="stylesheet" href="{{ asset("css/profil.css")}}">
<div id="content">
    <p>Profil de {{ $user->name }}</p>
    <p>Email : {{ $user->email }}</p>
    <p>right : {{ $user->right }}</p>
    <p>avatar : <img src="{{ $user->avatar }}" alt="Avatar" width="100"></p>
    <p>badge : {{ $user->badge }}</p>
    <a href="{{route('profile.edit', ['name' => $user->name]) }}">Modifier les informations du Profil</a>
</div>  
@endsection