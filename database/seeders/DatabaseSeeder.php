<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(10)->create();

        foreach ($users as $user) {
            $posts = Post::factory(3)->create([
                'user_id' => $user->id
            ]);

            foreach ($posts as $post) {
                Comment::factory(rand(1, 4))->create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id
                ]);
            }
        }
    }
}
