
@extends('layouts.mainlayout')

@section('content')
<h1>Movie Recommendations</h1>
    <p>{{ $recommendations }}</p>
    <a href="/">Back to Home</a>
@endsection