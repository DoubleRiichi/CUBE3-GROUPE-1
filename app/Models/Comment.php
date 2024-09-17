<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = ['content', 'movie_id', 'user_id'];


  public static function ById($id)
  {

    return self::find($id);
  }

  public static function BetweenDates($firstDate, $secondDate, $limit = null)
  {
    //TODO: add a verification for the date, it should be in the format "YYYY-MM-DD"
    return self::whereBetween("created_at", [$firstDate, $secondDate])->limit($limit)->get();
  }

  //If limit is null, it will be ignored so no need for an if-else 
  public static function BeforeDate($date, $limit = null)
  {

    return self::where("created_at", "<", $date)->limit($limit)->get();
  }

  public static function AfterDate($date, $limit = null)
  {

    return self::where("created_at", ">", $date)->limit($limit)->get();
  }

  public static function ByUserId($userId, $limit = null)
  {

    return self::where("user_id", "=", $userId)->limit($limit)->get();
  }

  public static function ByMovieId($movieId, $limit = null)
  {

    return self::where("movie_id", "=", $movieId)->limit($limit)->get();
  }

  public static function ByUserAndMovieId($movieId, $userId, $limit = null)
  {

    return self::where([
      ["movie_id", "=", $movieId],
      ["user_id"],
      "=",
      $userId
    ])->limit($limit)->get();
  }


  public static function InsertComment($user_id, $movie_id, $content)
  {
    $comment = new Comment;
    $comment->user_id = $user_id;
    $comment->movie_id = $movie_id;
    $comment->content = $content;

    $comment->save();
  }

  public static function remove($id)
  {
    $comment = Comment::find($id);
    $comment->delete();
  }

  public static function edit($id, $content)
  {
    $comment = Comment::find($id);
    $comment->content = $content;

    $comment->save();
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function movie()
  {
    return $this->belongsTo(Movie::class);
  }
}


