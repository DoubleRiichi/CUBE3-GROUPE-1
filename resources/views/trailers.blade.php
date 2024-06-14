<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Trailers</title>
</head>
<body>
    <h1>Movie Trailers</h1>

    <ul>
        @foreach ($videos as $video)
            <li>
                <h3>{{ $video->snippet->title }}</h3>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $video->id->videoId }}" frameborder="0" allowfullscreen></iframe>
            </li>
        @endforeach
    </ul>
</body>
</html>
