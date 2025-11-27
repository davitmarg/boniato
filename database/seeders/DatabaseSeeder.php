<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(20)->create();

        foreach ($users as $user) {
            $posts = Post::factory(3)->create([
                'user_id' => $user->id
            ]);

            foreach ($posts as $post) {
                $commenters = $users->random(rand(5, 10));

                foreach ($commenters as $commenter) {
                    Comment::factory()->create([
                        'post_id' => $post->id,
                        'user_id' => $commenter->id
                    ]);
                }

                $likers = $users->random(rand(3, 8));

                foreach ($likers as $liker) {
                    Like::factory()->create([
                        'user_id' => $liker->id,
                        'post_id' => $post->id
                    ]);
                }
            }
        }
    }
}
