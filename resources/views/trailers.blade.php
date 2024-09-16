<!DOCTYPE html>
<html>
<head>
    <title>Trailers</title>
</head>
<body>
    <h1>Film Trailers</h1>
    <ul>
        @foreach($movies as $movie)
            <li>
                <h2>{{ $movie->title }}</h2>
                @if($movie->trailerUrl)
                    <a href="{{ $movie->trailerUrl }}" target="_blank">Watch Trailer</a>
                @else
                    <p>No trailer available</p>
                @endif
            </li>
        @endforeach
    </ul>
</body>
</html>
