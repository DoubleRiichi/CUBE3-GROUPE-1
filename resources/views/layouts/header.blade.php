<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php 
        use Illuminate\Support\Facades\Route;
        echo Route::currentRouteName() ?></title>
    
</head>
<body>
<style>
body {

    background-image: url('{{ asset('Assets/background.webp') }}');
    margin: 0;
    padding: 0;
    font-family: Georgia, serif;
    background-size: cover;
    background-attachment: fixed;

    
}



header {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    background-color: #333;
    color: white;
    height: 5em;
    width: 100%;
    top : 0px;
    position:fixed;
    left:0px;

}

header a{
    color: white;
    font-size : 1em;
    justify-content: space-between;
    padding: 0em 5em;
    text-wrap: break-word;
    text-decoration: none;
    
}

header a:hover{

    
}

header div {
    padding-top: 2em;
    padding-bottom: 2em;

}
header div:hover {
    text-transform: capitalize;
    background-color: #555555;
}

header img {
 width: 20.9em;
 height: auto;
}

</style>
<header>
    <img src="{{ asset('Assets/logo-rectangle2.webp') }}" alt="logo">        
     <div>
        <a href="/home">Accueil</a>
    </div>
    <div>
        <a href="/Search">Recherche</a>
    </div>
    <div>     
        <a href="/Connection">Connexion</a>
    </div>     
    <div>
        <a href="/register">Inscription</a>
    </div>    
</header>   
    <br>
