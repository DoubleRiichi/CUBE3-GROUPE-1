<!DOCTYPE html>
<html>
<head>
    <title>Movie Recommendations</title>
</head>
<body>
    <h1>Movie Recommendations</h1>
    <h2>Here are some movies:</h2>
    <ul>
        @foreach ($movies as $movie)
            <li>{{ $movie->title }}</li>
        @endforeach
    </ul>

    <h2>Recommendation:</h2>
    <pre>{{ print_r($recommendation, true) }}</pre>
</body>
</html>
