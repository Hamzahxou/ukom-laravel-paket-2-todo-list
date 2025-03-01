<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = "tags";
    protected $fillable = [
        "tag_item_id",
        "task_id",
        "note_id"
    ];

    public function tagItem()
    {
        return $this->belongsTo(TagItem::class);
    }
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}
