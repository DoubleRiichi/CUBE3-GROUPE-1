@extends('layouts.mainlayout')

@section('content')
    <h1>Profil de {{ $user->name }}</h1>
    <p>Email : {{ $user->email }}</p>
   
@endsection