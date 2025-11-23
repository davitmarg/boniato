<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index()
    {
        // Get all posts, with their author, comments, and likes count
        $posts = Post::with(['user', 'comments.user', 'likes'])->latest()->get();
        return view('home', compact('posts'));
    }

    // 2. Store a new Post
    public function storePost(Request $request)
    {
        $request->validate(['content' => 'required']);

        Post::create([
            'user_id' => 1, // HARDCODED for now
            'content' => $request->content
        ]);

        return back();
    }

    // 3. Store a new Comment
    public function storeComment(Request $request, $postId)
    {
        $request->validate(['content' => 'required']);

        Comment::create([
            'user_id' => 1, // HARDCODED for now
            'post_id' => $postId,
            'content' => $request->content
        ]);

        return back();
    }

    // 4. Like/Unlike a Post
    public function toggleLike($postId)
    {
        $user = User::find(1); // HARDCODED
        $post = Post::find($postId);

        // Toggle the like (if exists, remove it; if not, add it)
        $post->likes()->toggle($user->id);

        return back();
    }
}
