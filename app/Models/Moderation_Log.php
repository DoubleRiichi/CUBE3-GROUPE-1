<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moderation_Log extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'action',
        'user_id'
    ];
    
    protected $table = "moderation_logs";
}
