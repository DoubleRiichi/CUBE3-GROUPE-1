<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Recommendations</title>
</head>
<body>
    <h1>Get Movie Recommendations</h1>
    <form method="POST" action="/recommend">
        @csrf
        <label for="user_input">What kind of movies do you like?</label>
        <textarea name="user_input" id="user_input" rows="4" cols="50"></textarea>
        <br>
        <button type="submit">Get Recommendations</button>
    </form>

    @if (isset($recommendedMovie))
        <h2>Recommended Movies:</h2>
        <p>{{ $recommendedMovie }}</p>
    @endif
</body>
</html>
