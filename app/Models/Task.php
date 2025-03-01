<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
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
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = 'TASK-';
        for ($i = 0; $i < $n; $i++) {
            $token .= $characters[rand(0, strlen($characters) - 1)];
        }
        $tokenCek = self::where('token', $token)->first();
        if ($tokenCek) {
            return $this->randomToken($n);
        }
        return $token;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->hasMany(Tag::class);
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
