<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <div id="movie-details">
        <h2> Voici ta liste {{$user->username}} </h2>
        @foreach ($list as $item)
        <div>
            <h3>{{ $item->title }}</h3>
            @if($item->poster_path)
            <img src="https://image.tmdb.org/t/p/w500{{ $item->poster_path }}" alt="{{ $item->title }} poster">
            @else
            <p>No poster available</p>
            @endif
            <p>{{$item->status}}</p>
        </div>
    </div>
    @endforeach

</body>
</html>
