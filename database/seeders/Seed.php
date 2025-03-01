<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\Tag;
use App\Models\TagItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class Seed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataUser = [
            [
                "name" => "hamzahxou",
                "email" => "hamzahxou@gmail.com",
                "password" => bcrypt('12345678')
            ],
        ];

        $dataNote = [
            [
                "title" => "Note 1",
                "content" => "Note 1 Content",
                "user_id" => 1
            ],
            [
                "title" => "Note 2",
                "content" => "Note 2 Content",
                "user_id" => 1
            ],
        ];
        $dataTagItem = [
            [
                "name" => "tag 1",
                "user_id" => 1
            ],
            [
                "name" => "tag 2",
                "user_id" => 1
            ],

        ];
        $dataTag = [
            [
                "tag_item_id" => 1,
                "note_id" => 1
            ],
            [
                "tag_item_id" => 2,
                "note_id" => 1
            ],
            [
                "tag_item_id" => 2,
                "note_id" => 2
            ]
        ];

        foreach ($dataUser as $user) {
            User::create($user);
        }
        foreach ($dataNote as $note) {
            Note::create($note);
        }
        foreach ($dataTagItem as $tagItem) {
            TagItem::create($tagItem);
        }
        foreach ($dataTag as $tag) {
            Tag::create($tag);
        }
    }
}
