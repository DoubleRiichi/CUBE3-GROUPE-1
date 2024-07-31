<?php 
 use App\Models\User; 

?>
@extends('layouts.mainlayout')

@section('content')
<link rel="stylesheet" href="{{ asset("css/movie-details.css")}}">
<link rel="stylesheet" href="{{ asset("css/comments.css")}}">
<link rel="stylesheet" href="{{asset("css/search.css")}}">



<div class="mainbox">
@if ($errors->any())
<div id="error-box">
    @foreach ($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif
    <h1>Panneau d'administration</h1>

    <div class="main-area">
        <div id="moderation-log">
            <h2>Historique d'administration</h2>
            <table>
            <caption>
            </caption>
            <thead>
                <th scope="col">Action</th>
                <th scope="col">Raison</th>
                <th scope="col">Par</th>
            </thead>
            <tbody>
            @if ($moderation_log && count($moderation_log) > 0)
                @foreach ($moderation_log as $moderation)

                    <tr>
                        <!-- TODO: dynamically fetch posters-->
                        <th scope="row">{{$moderation->action}}</th>
                        <td>{{$moderation->description}}</td>
                        <td>{{User::find($moderation->user_id)->name}}</td>
                    </tr>   
                @endforeach
            @else
               <tr> <th scope="row" colspan="3">Aucune action de modération réalisé !</th></tr>
            @endif
                </tbody>
                <tfoot>
                    <tr>
                    <th scope="row" colspan="2">Nombre de Résultats</th>
                    <td>{{count($moderation_log)}}</td>
                    </tr>
                </tfoot>
            </table>


        </div>

        <div id="last-comments">
            <h2>derniers commentaires</h2>

                <table>
                <caption>
                    
                </caption>
                <thead>
                    <th scope="col">Film</th>
                    <th scope="col">Utilisateur</th>
                    <th scope="col">Commentaire</th>                    
                    <th scope="col">Création</th>
                    <th scope="col">Modification</th>

                </thead>
                <tbody>
                @if ($comments && count($comments) > 0)
                    @foreach ($comments as $comment)
                    <?php
                        $author = User::find($comment->user_id);
                    ?>
                        <tr>
                            <!-- TODO: dynamically fetch posters-->
                            <th scope="row"><a href="/movie/{{$comment->movie_id}}">{{$comment->movie_id}}</a></th>
                            <td><a href="/profile/{{$author->name}}">{{$author->name}}</a></td>
                            <td>{{$comment->content}}</td>
                            <td>{{$comment->created_at}}</td>
                            <td>{{$comment->updated_at}}</td>
                        </tr>   
                    @endforeach
                
                @else
                <tr> <th scope="row" colspan="5">Pas de commentaires...</th></tr>   
                @endif
                    </tbody>
                    <tfoot>
                        <tr>
                        <th scope="row" colspan="4">Nombre de Résultats</th>
                        <td>{{count($comments)}}</td>
                        </tr>
                    </tfoot>
                </table>

        </div>
            
        <div id="banned-user">
        <h2>utilisateurs bannis</h2>
            <table>
            <caption>
            </caption>
            <thead>
                <th scope="col">Utilisateur</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </thead>
            <tbody>
            @if ($banned_users && count($banned_users) > 0)

                @foreach ($banned_users as $banned)
                    <tr>
                        <!-- TODO: dynamically fetch posters-->
                        <th scope="row">{{$banned->name}}</th>
                        <td>{{$banned->created_at}}</td>
                        <td>
                        <form action="/admin/unban" method="post">
                            @csrf
                            <input type="text" name="id" id="" value="{{$banned->id}}" hidden>
                            <textarea name="description" id="" cols="30" rows="3"></textarea>
                            <button class="redbtn" type="submit">déban</button>
                        </form>
                        </td>
                    </tr>   
                @endforeach
            @else
            <tr> <th scope="row" colspan="5">Pas de bans = pas d'utilisateurs :)</th></tr>
            @endif   
                </tbody>
                <tfoot>
                    <tr>
                    <th scope="row" colspan="1">Nombre de Résultats</th>
                    <td>{{count($banned_users)}}</td>

                    </tr>
                </tfoot>
            </table>

     
        </div>
    </div>
</div>
@endsection