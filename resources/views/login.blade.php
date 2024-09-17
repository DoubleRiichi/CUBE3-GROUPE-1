@extends('layouts.mainlayout')
@section ('title', 'Connexion')
@section('content')
<link rel="stylesheet" href="{{ asset("css/register.css")}}">
<div class="row" id="register">
    <div class="col col-md-4 mx-auto bg-light mt-4 p-3 text-center">
        <h1>Connexion</h1>
        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form class="inline-form" method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required>
            </div>
            <div>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>
            <div>
                <button class="bluebtn" type="submit">Se connecter</button>
            </div>
        </form>
        <a href="{{ route('auth.google') }}" class="btn googlebtn">
            <img src="{{ asset('Assets/google-logo.png') }}" alt="Google logo">Google
        </a>
    </div>
</div>
@endsection
