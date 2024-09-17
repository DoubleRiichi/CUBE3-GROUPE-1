<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Banned_User extends Model
{
    use HasFactory;
    protected $table = "banned_users";

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'username',
        'permissions',
        'avatar',
        'badge',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function Add()
    {

    }
}
