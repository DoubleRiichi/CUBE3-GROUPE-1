@extends('layouts.mainlayout')
@section ('title', 'Résultat des recommandations')
@section('content')
<div class="mainbox">
    <h1>Résultat des recommandations</h1>
    <p>{{ $recommendationText }}</p>
    <a href="{{ route('showForm') }}">Revenir au formulaire</a>
</div>
</body>
</html>
