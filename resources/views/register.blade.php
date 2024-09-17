@extends('layouts.mainlayout')
@section ('title', 'Inscription')
@section('content')
<link rel="stylesheet" href="{{ asset("css/register.css")}}">
<div class="row" id="register">
    <div class="col col-md-4 mx-auto bg-light mt-4 p-3 text-center">

        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form class="inline-form" method="POST" action="{{ route('register') }}">
            <h1>Créer un compte</h1>

            @csrf
            <div>
                <label for="name">Nom Prénom</label> <br>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div>
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div>
                <label for="password">Mot de passe</label><br>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="password_confirmation">Confirmez mot de passe</label><br>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div>
                <label for="username">Pseudo</label><br>
                <input type="text" id="username" name="username" value="{{ old('username') }}" required>
            </div>
            <div>
                <button class="bluebtn" type="submit">S'inscrire</button>
            </div>

        </form>
        <a href="{{ route('auth.google') }}" class="btn googlebtn">
            <img src="{{ asset('Assets/google-logo.png') }}" alt="Google logo">Google
        </a>
    </div>
</div>
@endsection
