@extends('layouts.mainlayout')
@section ('title', 'Liste de films')
@section('content')
<link rel="stylesheet" href="{{ asset('css/listing-movies.css') }}">
<div class="row">
    <div class="col col-md-8 mx-auto bg-light mt-4 p-3 text-center">
        <h2> La liste de {{$user->username}} </h2>
        <div class='table-responsive'>
            <table class='table'>
                <thead>
                    <tr>
                        <th>Titre du film</th>
                        <th>Vus/À voir</th>
                        <th>Note</th>
                        <th class="col-md-4"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $item)
                    <tr>
                        <td>
                            <a href="{{ url('/movie/' . $item->movie_id) }}">{{ $item->title }}</a>
                        </td>
                        <td>
                            <form action="{{ url('/list/toggle/' . $item->id) }}" method="POST">
                                @csrf
                                <input type="checkbox" name="viewed" {{ $item->status == 'Vus' ? 'checked' : '' }} {{ !Auth::check() ? 'disabled' : '' }} onchange="this.form.submit()">
                                <input type="text" name="user_id" hidden value="{{ $user->id }}">
                            </form>
                        </td>
                        <td>
                            @if ($item->rating === null)
                            <span class="base">Non noté</span>
                            @else
                            <span class="listing-note">{{ $item->rating }}</span><span class="base"> /10</span>
                            @endif
                        </td>
                        @if (Auth::check())
                        <td>
                            <div class="rate-container">
                                <form hidden id="rate-form-{{ $item->id }}" action="{{ url('/list/rate/' . $item->id) }}" method="POST">
                                    @csrf
                                    <input type="number" name="rating" min="0" max="10" value="{{ $item->rating }}" class="rate-input">
                                    <input type="text" name="user_id" hidden value="{{ $user->id }}">
                                </form>
                                <button class="bluebtn rate-btn" data-form-id="rate-form-{{ $item->id }}">Noter</button>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{asset("js/listing.js")}}"></script>
@endsection
