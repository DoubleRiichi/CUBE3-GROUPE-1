<!DOCTYPE html>
<html>
<head>
    <title>Movie Recommendations</title>
</head>
<body>
    <h1>Films recommandés</h1>
    <h2>Voici les films recommandés :</h2>
    <ul>
        @foreach ($movies as $movie)
            <li>{{ $movie->title }}</li>
        @endforeach
    </ul>

    <h2>Recommendation:</h2>
    <p>{{ $recommendation }}</p>
</body>
</html>
