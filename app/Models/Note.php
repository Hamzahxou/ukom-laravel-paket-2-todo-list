<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = "notes";
    protected $fillable = [
        "title",
        "content",
        "user_id"
    ];

    public function tags()
    {
        // return $this->hasMany(Note::class);
        return $this->belongsToMany(TagItem::class, 'tags', 'note_id', 'tag_item_id');
    }
}
