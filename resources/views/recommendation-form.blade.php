@extends('layouts.mainlayout')
@section ('title', 'Formulaire de recommandation')
@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
<link rel="stylesheet" href="{{ asset('css/recommendation.css') }}">
<div class="row">
    <div class="col col-md-4 mx-auto bg-light mt-4 p-3 text-center">
        <h1>Recommandations de films</h1>
        <form action="{{ route('recommend') }}" method="POST">
            @csrf
            <label for="genre">Genre de film:</label>
            <input type="text" id="genre" name="genre" required>
            <button type="submit">Obtenir des recommandations</button>
        </form>
    </div>
</div>

@endsection
