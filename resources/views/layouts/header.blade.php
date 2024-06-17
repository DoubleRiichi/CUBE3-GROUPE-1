<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body >
    <header>
    <img src="{{ asset('Assets/logo-rectangle2.webp') }}" alt="logo">
    
        <a href="Home">Accueil</a>
        <a href="Search">Recherche</a>
        <a href="Connection">Connexion</a>
        <a href="Subscription">Inscription</a>
<style>
body {
    
    background-image: url('{{ asset('Assets/background.webp') }}');
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Georgia, serif;
    background-size: cover;
    position : absolute;
}



header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0em 0em;
    background-color: #333;
    color: white;
    height: 5em;
    top : 0;
}

header a{
    color: white;
    font-size : 1em;
    justify-content: space-between;
    padding: 0em 5em;
    display: flex inline;
    text-wrap: break-word;
    text-decoration: none;
    
}

img {
 width: 20.9em;
 height: auto;
}

</style>
    </header>   
