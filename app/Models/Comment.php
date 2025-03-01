<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";
    protected $fillable = [
        "task_id",
        "user_id",
        "content"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
