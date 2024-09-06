@extends('layouts.mainlayout')
@section ('title', 'Liste de films')
@section('content')
<link rel="stylesheet" href="{{ asset('css/listing-movies.css') }}">
<div class="mainbox" id="listing-movies">
    <h2> La liste de {{$user->username}} </h2>
    <table>
        <thead>
            <tr>
                <th>Titre du film</th>
                <th>Vus/À voir</th>
                <th>Note</th>
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
                <td>
                    <span class="listing-note">{{$item->rating}}</span><span class="base"> /10</span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>  
@endsection
