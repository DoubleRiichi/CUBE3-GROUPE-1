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
    <li>
        <a href="Home">Accueil</a>
        <a href="Shearch">Recherche</a>
        <a href="Connexion">Connection</a>
        <a href="Inscription">Inscription</a>
    </li>
    </header>   
<style>
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1em 2em;
    background-color: #333;
    color: white;
}

a{
    color: white;
    font-size : 1em;
}

img{
    display: wrap;

}

</style>