@extends('layouts.mainlayout')
@section ('title', 'Connexion')
@section('content')
<!-- <link rel="stylesheet" href="{{ asset("css/register.css")}}"> -->
<div class="row" id="register">
    <div class="col col-md-4 m-5 text-center mx-auto bg-light p-3">
        <h1>Connection</h1>
        @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form class="form" id="register" method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="E-mail" required>
            </div>
            <div>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
            </div>

            <div class="row d-flex align-items-center mx-0 p-0">
                <div class="col-7 text-end">
                    <div>
                        <button class="bluebtn" type="submit">Se connecter</button>  
                    </div>
                </div>
                <div class="col-5 text-start">
                    <a href="{{ route('auth.google') }}" class="btn google mt-3">
                        <img width="40" class="img-fluid" src="{{ asset('Assets/google-logo.png') }}" alt="Google logo"> <span class="text-dark">Google</span>
                    </a>
                </div>

            </div>



        </form>

    </div>
</div>
@endsection
