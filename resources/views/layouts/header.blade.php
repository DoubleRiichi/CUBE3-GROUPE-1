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
    
    background-color: #555555;
    
}

header div {
    padding-top: 2em;
    padding-bottom: 2em;
    width: auto;

}

header img {
 width: 20.9em;
 height: auto;
}

</style>
<header>
    <img src="{{ asset('Assets/logo-rectangle2.webp') }}" alt="logo">        
     
    <a href="/home"><div>Accueil</div></a>
    
    
    <a href="/Search"><div>Recherche</div></a>
    
         
    <a href="/Connection"><div>Connexion</div></a>
    
    
    <a href="/register"><div>Inscription</div></a>
        
</header>   
    <br>
