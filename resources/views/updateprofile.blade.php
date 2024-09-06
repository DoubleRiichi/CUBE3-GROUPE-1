@extends('layouts.mainlayout')
@section ('title', 'Modification de profil')
@section('content')
<link rel="stylesheet" href="{{ asset("css/profil.css")}}">
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="mainbox" id="profil">
    <h1>Profil de {{ Auth::user()->name }}</h1>
    <form action="{{ route('profile.update', ['name' => $user->name]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
            @if ($errors->has('name'))
            <div class="text-danger">{{ $errors->first('name') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
            @if ($errors->has('email'))
            <div class="text-danger">{{ $errors->first('email') }}</div>
            @endif
        </div>
        <!-- <div class="form-group">
            <label for="right">Droits :</label>
            <input type="text" id="right" name="permissions" class="form-control" value="{{ Auth::user()->right }}" required>
        </div> -->
        <div class="form-group">
            <label for="badge">Badge :</label>
            <input type="text" id="badge" name="badge" class="form-control" value="{{ Auth::user()->badge }}" required>
            @if ($errors->has('badge'))
            <div class="text-danger">{{ $errors->first('badge') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="avatar">Avatar :</label>
            <input type="file" id="avatar" name="avatar" class="form-control-file">
            @if (Auth::user()->avatar)
            <div class="mt-2 avatar-container" style="display: inline-block;">
                <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="avatar">
            </div>
            @endif
            @if ($errors->has('avatar'))
            <div class="text-danger">
                @foreach ($errors->get('avatar') as $message)
                <p>{{ $message }}</p>
                @endforeach
            </div>
            @endif
        </div>
        <button type="submit" class="redbtn">Mettre à jour</button>
    </form>
</div>
@endsection
