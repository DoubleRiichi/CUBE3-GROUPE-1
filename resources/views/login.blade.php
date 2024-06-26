@extends('layouts.mainlayout')

@section('content')
<link rel="stylesheet" href="{{ asset("css/register.form.css")}}">
<div id="register-form">

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('login') }}">
    <h1>Login</h1>

    @csrf

        <div>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required>
        </div>
       
        <div>
            <button type="submit">Login</button>
        </div>

    </form>
    <a href="{{ route('auth.google') }}" class="btn btn-primary">Login with Google</a>
</div>
@endsection