<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberTask extends Model
{
    protected $table = 'member_tasks';
    protected $fillable = ['member_id', 'task_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class, "member_id", "id");
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
