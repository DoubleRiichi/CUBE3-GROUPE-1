@extends('layouts.mainlayout')

@section('content')
<h1>Movie Trailers</h1>

<ul>
    @foreach ($results as $result)
    <li>
        <h3> {{ $result->title }} </h3>
    </li>
    @endforeach
</ul>
@endsection
