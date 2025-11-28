<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::with(['user', 'comments', 'likes'])
            ->latest()
            ->paginate(4);

        if ($request->header('HX-Request')) {
            return view('partials.feed', compact('posts'));
        }

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



    public function toggleLike($postId)
    {
        $post = Post::findOrFail($postId);
        $post->likes()->toggle(Auth::id());

        $post->load('likes');

        return view('partials.like-button', compact('post'));
    }
}
