<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    protected $fillable = ['title', 'description', 'priority', 'completed', 'token',  'progress', 'user_id'];


    public function token(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value,
            set: function ($value) {
                $value = $this->randomToken(6);
                return $value;
            }
        );
    }

    protected function randomToken($n)
    {
        $token = '';
        do {
            $token = "TASK_" . Str::random($n);
        } while (self::where('token', $token)->exists());
        return $token;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        // return $this->hasMany(Tag::class);
        return $this->belongsToMany(TagItem::class, 'tags', 'task_id', 'tag_item_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function members()
    {
        return $this->hasMany(MemberTask::class);
    }
}
