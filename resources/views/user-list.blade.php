@extends('layouts.mainlayout')
@section ('title', "Utilisateurs")
@section("content")
<link rel="stylesheet" href="{{ asset("css/movie-details.css")}}">
<link rel="stylesheet" href="{{ asset("css/comments.css")}}">
<link rel="stylesheet" href="{{asset("css/search.css")}}">

<div class="row ">
    <div class="col col-md-8 mx-auto bg-white my-4 py-4">
        <div class="row">
            <div class="col">
            <form class="inline-form" id="search-form" method="POST" action="/admin/users">
                @csrf

                <label class="form-label" for="name">Pseudo : </label>
                <input class="form-control" type="text" name="name" id="" size="50">
                <label class="form-label" for="beforeDate">Avant : </label>
                <input class="form-control" type="date" name="beforeDate" id="">
                <label class="form-label" for="afterDate">Après : </label>
                <input class="form-control" type="date" name="afterDate" id="">
    
                <button class="btn bluebtn ml-5 mt-3" type="submit">Chercher</button>
            </form>
            </div>
        </div>
        
        <div class="row">
                <div class="col col-md-10 table-responsive m-auto">
                    <h2>Utilisateurs</h2>
                    <hr>

                    <table class="table table-bordered table-hover table-striped text-center ">
                        <caption>
                        </caption>
                        <thead>
                            <th scope="col">Avatar</th>
                            <th scope="col">Pseudo</th>
                            <th scope="col">Inscription</th>
                            <th scope="col">Status</th>
                        </thead>
                        <tbody>
                            @if ($users && count($users) > 0)

                            @foreach ($users as $user)
                            <tr>
                                <!-- TODO: dynamically fetch posters-->
                                
                                <th scope="row"><img height="64" width="64" class="img-fluid rounded" src="{{$user->avatar}}" alt="avatar de {{$user->username}}"></th>
                                <th><a href="/profile/{{$user->name}}">{{$user->name}}</a></th>
                                <td>{{$user->created_at->format("d/m/Y H:i:s")}}</td>
                                <td>{{$user->permissions}}</td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <th scope="row" colspan="5">Aucun utilisateur inscrit!</th>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="row" colspan="3">Nombre de Résultats</th>
                                <td>{{count($users)}}</td>

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
    </div>
</div>


@endsection