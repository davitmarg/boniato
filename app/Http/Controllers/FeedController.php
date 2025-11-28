<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class FeedController extends Controller
{
    public function index(Request $request)
    {
        // 1. Create a unique cache key based on User, Page, and Request Type
        $userId = Auth::id() ?? 'guest';
        $page = $request->get('page', 1);
        $type = $request->header('HX-Request') ? 'partial' : 'full';

        $key = "feed_user:{$userId}_page:{$page}_type:{$type}";

        // 2. Cache the rendered view for 10 seconds
        return Cache::remember($key, 10, function () use ($request) {

            $posts = Post::with(['user', 'comments', 'likes'])
                ->latest()
                ->paginate(4);

            if ($request->header('HX-Request')) {
                return view('partials.feed', compact('posts'))->render();
            }

            return view('home', compact('posts'))->render();
        });
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
