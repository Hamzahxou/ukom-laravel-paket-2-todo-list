<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReplyComment extends Model
{
    protected $table = "reply_comments";
    protected $fillable = [
        "comment_id",
        "user_id",
        "content"
    ];
}
