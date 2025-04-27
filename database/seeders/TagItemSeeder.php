<?php

namespace Database\Seeders;

use App\Models\TagItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TagItem::factory()->count(10)->create();
    }
}
