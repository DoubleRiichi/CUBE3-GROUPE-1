@extends('layouts.mainlayout')

@section('content')
<link rel="stylesheet" href="{{ asset("css/profil.css")}}">
@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
<div id="content">
    <h1>Profil de {{ Auth::user()->name }}</h1>
    <form action="{{ route('profile.update', ['name' => $user->name]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
        </div>
        <div class="form-group">
            <label for="right">Droits :</label>
            <input type="text" id="right" name="permissions" class="form-control" value="{{ Auth::user()->right }}" required>
        </div>
        <div class="form-group">
            <label for="badge">Badge :</label>
            <input type="text" id="badge" name="badge" class="form-control" value="{{ Auth::user()->badge }}" required>
        </div>
        <div class="form-group">
            <label for="avatar">Avatar :</label>
            <input type="file" id="avatar" name="avatar" class="form-control-file">
            @if (Auth::user()->avatar)
                <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="mt-2" width="100">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
    </div>
@endsection