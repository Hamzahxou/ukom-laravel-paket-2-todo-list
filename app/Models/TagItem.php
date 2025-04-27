<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TagItem extends Model
{
    use HasFactory;
    protected $table = 'tag_items';
    protected $fillable = ['name', 'slug', 'user_id'];

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value,
            set: function ($value) {
                return [
                    'name' => $value,
                    'slug' => Str::slug($value),
                ];
            }
        );
    }

    public function tags()
    {
        return $this->hasMany(Tag::class, 'tag_item_id', 'id');
    }
}
