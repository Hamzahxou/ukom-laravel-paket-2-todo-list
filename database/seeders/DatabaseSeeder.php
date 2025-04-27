<?php

namespace Database\Seeders;

use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'hamzahxou',
            'email' => 'hamzahxou@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $this->call([
            TaskSeeder::class,
            TagItemSeeder::class,
        ]);

        $task = Task::first();
        $task->tags()->attach([1, 2, 3]);
    }
}
