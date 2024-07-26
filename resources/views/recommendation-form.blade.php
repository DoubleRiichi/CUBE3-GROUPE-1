<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de recommandation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <style>
        body {
            background-image: url('{{ asset('Assets/background-origin.webp') }}');
            margin: 0;
            padding: 0;
            font-family: Helvetica, serif;
            background-size: cover;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh; 
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 500px; 
            width: 100%; 
        }

        h1 {
            margin-top: 0;
            text-align: center; 
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label, input, button {
            margin-bottom: 10px;
        }

        button {
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Recommandations de films</h1>
        <form action="{{ route('recommend') }}" method="POST">
            @csrf
            <label for="genre">Genre de film:</label>
            <input type="text" id="genre" name="genre" required>
            <button type="submit">Obtenir des recommandations</button>
        </form>
    </div>
</body>
</html>
