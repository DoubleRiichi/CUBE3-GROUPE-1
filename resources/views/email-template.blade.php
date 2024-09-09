<title>Bienvenue sur MovieShelter</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        padding: 1rem;
    }

    .container {
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #333333;
        font-size: 24px;
        margin-bottom: 1rem;
    }

    p {
        color: #666666;
        font-size: 16px;
        line-height: 1.5;
        margin-bottom: 1rem;
    }

    .button {
        display: inline-block;
        background-color: #007bff;
        color: #ffffff;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
    }

    .button:hover {
        background-color: #0056b3;
    }

</style>
<div class="container">
    <img width="150" src="{{ $message->embed(public_path('Assets/logo_vertical.webp')) }}" alt="logo">
    <h1>Bienvenue sur MovieShelter !</h1>
    <p>Merci de vous être inscrit à notre communauté. Nous sommes ravis de vous avoir parmi nous.</p>
    <p>Commencez à explorer notre vaste collection de films et profitez de l'expérience cinématographique ultime.</p>
    <p>Si vous avez des questions ou besoin d'aide, n'hésitez pas à contacter notre équipe de support.</p>
    <p>Bon visionnage !</p>
    <a href="http://127.0.0.1:8000/home" class="button">Visiter MovieShelter</a>
</div>
</body>
</html>
