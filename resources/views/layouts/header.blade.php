<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
    <img src="{{ asset('Assets/Logo movie shelter.webp') }}" alt="logo">
    
        <a href="Home">Accueil</a>
        <a href="Shearch">Recherche</a>
        <a href="Connexion">Connection</a>
        <a href="Inscription">Inscription</a>
        <style>
body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
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
    
}

img {
height: auto; 
max-width: 5em;
}

</style>
    </header>   
