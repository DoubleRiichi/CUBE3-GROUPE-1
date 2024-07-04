@extends('layouts.mainlayout')

@section('content')
<link rel="stylesheet" href="{{ asset("css/register.form.css")}}">
<div id="content">

    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        <h1>Créer un compte</h1>

        @csrf
        <div>
            <label for="name">Name</label> <br>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="password_confirmation">Confirm Password</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>
        <div>
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required>
        </div>
        <div>
            <button class="btn-register" type="submit">S'inscrire</button>
        </div>

    </form>
    <a href="{{ route('auth.google') }}" class="btn-google">
        <img src="{{ asset('Assets/google-logo.png') }}" alt="Google logo">Google
    </a>
</div>
@endsection
