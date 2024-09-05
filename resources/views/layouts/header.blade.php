<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php 
        use Illuminate\Support\Facades\Route;
        echo Route::currentRouteName() ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: url('{{ asset('Assets/background.webp') }}');
            margin: 0;
            padding: 0;
            font-family: Helvetica, serif;
            background-size: cover;
            background-attachment: fixed;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ebebeb;
            height: 5em;
            width: 100%;
            top: 0px;
            position: fixed;
            left: 0px;
        }

        header .logo-container {
            display: flex;
            align-items: center;
        }

        header img {
            width: auto;
            height: 5em;
        }

        nav {
            overflow: hidden;
            padding: 10px;
        }

        .links {
            font-weight: bold;
            color: #35607c;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
            line-height: 25px;
            border-radius: 4px;
            flex-grow: 1;
            padding: 1em 0;
            white-space: nowrap;
        }

        nav .links:hover {
            background-color: #35607c;
            color: #FFFFFF;
        }

        .rightSection {
            display: flex;
            flex-grow: 1;
            justify-content: space-around;
        }

        @media screen and (max-width: 900px) {
            .rightSection {
                flex-direction: column;
                align-items: center;
            }
        }

        button {
            background-color: #35607c;
            color: white;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            margin-right: 10px;
        }

        .burger-menu {
            display: none;
        }

        .burger-menu.active {
            display: flex;
            flex-direction: column;
            position: absolute;
            width: 120px;
            top: 60px;
            right: 0;
            background-color: #35607c;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px; 
        }

        @media (min-width: 900px) {
            .burgersection {
                display: none;

            }
        }

        @media (max-width: 900px) {
            .links {
                display: none;

            }
        }

        .burgerking {
            color: white;
            font-size: 1em;
            flex-grow: 1;
            text-align: center;
            padding: 1em 0;
            text-decoration: none;
            white-space: nowrap;
        }

        .burgerking:hover {
            background-color: #27496d;
            border-radius: 10px;
        }

    </style>
</head>
<body>
    <nav>
        <header>
            <div class="logo-container">
                <img src="{{ asset('Assets/logo_vertical.webp') }}" alt="logo">
            </div>
            <div class="rightSection">
                <a class="links" href="/home">Accueil</a>
                <a class="links" href="/search">Recherche</a>
                <a class="links" href="/recommendation-form">Recommendation</a>
                <?php use Illuminate\Support\Facades\Auth;
        $user = Auth::check();
        ?>
                @if($user)
                <a class="links" href="/list/{{Auth::id()}}">Ma liste</a>
                <a class="links" href="{{ route('profile.show', ['name' => Auth::user()->name]) }}">Profil</a>

                @if(Auth::user()->permissions == "admin")
                <a class="links" href="/admin">Admin</a>
                @endif

                <a class="links" href="/logout">Deconnexion</a>
                @else
                <a class="links" href="/login">Connexion</a>
                <a class="links" href="/register">Inscription</a>
                @endif

            </div>
            <div class="burgersection">
                <button id="burgerMenuButton">☰</button>
                <nav id="burgerMenu" class="burger-menu">
                    <a class="burgerking" href="/home">Accueil</a>
                    <a class="burgerking" href="/search">Recherche</a>
                    <?php
        $user = Auth::check();
        ?>
                    @if($user)
                    <a class="burgerking" href="/list/{{Auth::id()}}">Ma liste</a>
                    <a class="burgerking" href="{{ route('profile.show', ['name' => Auth::user()->name]) }}">Profil</a>
                    @if (Auth::user()->permissions == "admin")
                    <a class="burgerking" href="/admin">Admin</a>
                    @endif
                    <a class="burgerking" href="/logout">Deconnexion</a>
                    @else
                    <a class="burgerking" href="/login">Connexion</a>
                    <a class="burgerking" href="/register">Inscription</a>
                    @endif

            </div>
    </nav>
    </header>

    <br>
    <script src="{{ asset('js/burger.js') }}"></script>">
</body>
</html>
