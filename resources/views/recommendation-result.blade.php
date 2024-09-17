@extends('layouts.mainlayout')
@section ('title', 'Résultat des recommandations')
@section('content')

<link rel="stylesheet" href="{{ asset('css/recommendation.css') }}">
<div class="row">
    <div class="col col-md-4 mx-auto bg-light mt-4 p-3 text-center">
        <h1>Résultat des recommandations</h1>
        <p>{{ $recommendationText }}</p>
        <a href="{{ route('showForm') }}" class="btn bluebtn">Revenir au formulaire</a>
    </div>
</div>
</body>
</html>
