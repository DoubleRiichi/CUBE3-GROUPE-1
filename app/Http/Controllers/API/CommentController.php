<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Movie;

class CommentController extends Controller
{

    public function addComment(Request $request)
    {
        $request->validate([
            'content' => ['required', 'string', 'max:255'],
            'movie_id' => ['required', 'exists:movies,id'],
        ]);
        $user = Auth::user();
        $movie = Movie::find($request->movie_id);

        $comment = Comment::create([
            'content' => $request->content,
            'user_id' => $user->id,
            'movie_id' => $movie->id,
        ]);

        return response()->json([
            "status_code" => 200,
            "status" => "success",
            "message" => "Commentaire ajouté avec succès",
            "comment" => $comment,
            "movie" => $movie,
        ], 200);
    }

    public function removeComment($id)
    {
        $user = Auth::user();
        $comment = Comment::find($id);

        if (!$comment || $comment->user_id != $user->id) {
            return response()->json([
                "status_code" => 404,
                "status" => "error",
                "message" => "Commentaire non trouvé ou non autorisé"
            ], 404);
        }

        $comment->delete();

        return response()->json([
            "status_code" => 200,
            "status" => "success",
            "message" => "Commentaire supprimé avec succès"
        ], 200);
    }

    public function updateComment(Request $request, $id)
    {
        $request->validate([
            'content' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();
        $comment = Comment::find($id);

        if (!$comment || $comment->user_id != $user->id) {
            return response()->json([
                "status_code" => 404,
                "status" => "error",
                "message" => "Commentaire non trouvé ou non autorisé"
            ], 404);
        }

        $comment->content = $request->content;
        $comment->save();

        return response()->json([
            "status_code" => 200,
            "status" => "success",
            "message" => "Commentaire modifié avec succès",
            "comment" => $comment
        ], 200);
    }

    public function getMovieComments($movie_id)
    {
        $movie = Movie::find($movie_id);
        if (!$movie) {
            return response()->json([
                "status_code" => 404,
                "status" => "error",
                "message" => "Film non trouvé"
            ], 404);
        }
        $comments = $movie->comments()->with('user')->get();
        return response()->json($comments);
    }

    public function getUserComments(Request $request)
    {
        $user = Auth::user();
        $comments = $user->comments()->with('movie')->get();
        return response()->json($comments);
    }
}
