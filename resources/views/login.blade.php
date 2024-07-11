@extends('layouts.mainlayout')

@section('content')
<link rel="stylesheet" href="{{ asset("css/register.css")}}">
<div class="mainbox" id="register">

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form class="inline-form" id="register" method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required>
        </div>
        <div>
            <input type="password" id="password" name="password" placeholder="Mot de passe" required>
        </div>

        <div>
            <button class="redbtn" type="submit">Se connecter</button>
        </div>

    </form>
    <a href="{{ route('auth.google') }}" class="btn google">
        <img src="{{ asset('Assets/google-logo.png') }}" alt="Google logo">Google
    </a>
</div>
@endsection
