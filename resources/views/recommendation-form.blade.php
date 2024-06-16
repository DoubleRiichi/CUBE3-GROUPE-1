<!-- resources/views/recommendation-form.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de recommandation</title>
</head>
<body>
    <h1>Recommandations de films</h1>
    <form action="{{ route('recommend') }}" method="POST">
        @csrf
        <label for="genre">Genre de film:</label>
        <input type="text" id="genre" name="genre" required>
        <button type="submit">Obtenir des recommandations</button>
    </form>
</body>
</html>
