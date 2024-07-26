<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php 
        use Illuminate\Support\Facades\Route;
        echo Route::currentRouteName() ?></title>
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
            background-color: #333;
            color: white;
            height: 5em;
            width: 100%;
            top: 0px;
            position: fixed;
            left: 0px;
        }

        header a {
            color: white;
            font-size: 1em;
            flex-grow: 1;
            text-align: center;
            padding: 1em 0;
            text-decoration: none;
            white-space: nowrap;
        }

        header a:hover {
            background-color: #555555;
        }

        header .logo-container {
            display: flex;
            align-items: center;
        }

        header img {
            width: 20.9em;
            height: auto;
        }

        nav {
            overflow: hidden;
            background-color: #330b7c;
            padding: 10px;
        }

        .links {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: bold;
            color: white;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
            line-height: 25px;
            border-radius: 4px;
        }

        nav .links:hover {
            background-color: rgb(214, 238, 77);
            color: rgb(42, 10, 94);
        }

        .rightSection {
            display: flex;
            flex-grow: 1;
            justify-content: space-around;
        }

        @media screen and (max-width: 870px) {
            .rightSection {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
<nav>
<header>
    <div class="logo-container">
        <img src="{{ asset('Assets/logo-rectangle2.webp') }}" alt="logo">
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
            <a class="links" href="/logout">Deconnexion</a>
        @else
            <a class="links" href="/login">Connexion</a>
            <a class="links" href="/register">Inscription</a>
        @endif
    </div>
</header> 
</nav>  
<br>
</body>
</html>