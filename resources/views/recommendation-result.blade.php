<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat des recommandations</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 600px;
            text-align: center;
        }
        h1 {
            margin-top: 0;
        }
        p {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Résultat des recommandations</h1>
        <p>{{ $recommendationText }}</p>
        <a href="{{ route('showForm') }}">Revenir au formulaire</a>
    </div>
</body>
</html>
