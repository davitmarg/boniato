<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;

class LikeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'post_id' => Post::factory(),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
