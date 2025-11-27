<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;

class FeedController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'comments', 'likes'])->latest()->get();
        return view('home', compact('posts'));
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function showProfile($id)
    {
        $user = User::findOrFail($id);
        $posts = $user->posts()->with(['likes', 'comments'])->latest()->get();
        return view('profile', compact('user', 'posts'));
    }

    public function showPost($id)
    {
        $post = Post::with(['user', 'comments.user', 'likes'])->findOrFail($id);
        return view('post.show', compact('post'));
    }

    public function storePost(Request $request)
    {
        $request->validate(['content' => 'required']);

        Post::create([
            'user_id' => auth()->id(),
            'content' => $request->content
        ]);

        return back();
    }

    public function storeComment(Request $request, $postId)
    {
        $request->validate(['content' => 'required']);

        Comment::create([
            'user_id' => auth()->id(),
            'post_id' => $postId,
            'content' => $request->content
        ]);

        return back();
    }

    public function toggleLike($postId)
    {
        $user = auth()->user();
        $post = Post::find($postId);
        $post->likes()->toggle($user->id);

        return back();
    }
}
