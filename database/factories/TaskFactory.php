<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(20),
            'priority' => random_int(1, 3),
            'completed' => random_int(0, 1),
            'token' => "",
            'progress' => random_int(0, 100),
            'user_id' => 1
        ];
    }
}
