@extends('layouts.mainlayout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/listing_movies.css') }}">
<div id="content">
    <h2> La liste de {{$user->username}} </h2>
    <table>
        <thead>
            <tr>
                <th>Titre du film</th>
                <th>Vus/À voir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($list as $item)
            <tr>
                <td>
                    <a href="{{ url('/movie/' . $item->movie_id) }}">{{ $item->title }}</a>
                </td>
                <td>
                    <input type="checkbox" name="viewed" {{ $item->status == 'Vus' ? 'checked' : '' }} disabled>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
