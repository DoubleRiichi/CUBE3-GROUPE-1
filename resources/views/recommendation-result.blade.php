@extends('layouts.mainlayout')
@section ('title', 'Résultat des recommandations')
@section('content')

<link rel="stylesheet" href="{{ asset('css/recommendation.css') }}">
<div class="mainbox">
    <h1>Résultat des recommandations</h1>
    <p>{{ $recommendationText }}</p>
    <a href="{{ route('showForm') }}" class="btn bluebtn">Revenir au formulaire</a>
</div>
</body>
</html>
