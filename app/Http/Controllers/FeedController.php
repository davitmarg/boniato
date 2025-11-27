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

    public function showPost($id)
    {
        $post = Post::with(['user', 'comments.user', 'likes'])->findOrFail($id);
        return view('post.show', compact('post'));
    }

    public function storePost(Request $request)
    {
        $request->validate(['content' => 'required']);

        Post::create([
            'user_id' => Auth::id(),
            'content' => $request->content
        ]);

        return back();
    }

    public function updatePost(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if (Auth::id() !== $post->user_id) {
            abort(403);
        }

        $request->validate(['content' => 'required']);

        $post->update([
            'content' => $request->content
        ]);

        return redirect()->route('post.show', $post->id);
    }

    public function deletePost($id)
    {
        $post = Post::findOrFail($id);

        if (Auth::id() !== $post->user_id) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('home');
    }

    public function storeComment(Request $request, $postId)
    {
        $request->validate(['content' => 'required']);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $postId,
            'content' => $request->content
        ]);

        return back();
    }

    public function updateComment(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }

        $request->validate(['content' => 'required']);

        $comment->update([
            'content' => $request->content
        ]);

        return back();
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }

        $comment->delete();

        return back();
    }

    public function toggleLike($postId)
    {
        $post = Post::findOrFail($postId);
        $post->likes()->toggle(Auth::id());

        $post->load('likes');

        return view('partials.like-button', compact('post'));
    }

    public function editPost($id)
    {
        $post = Post::findOrFail($id);

        if (Auth::id() !== $post->user_id) {
            abort(403);
        }

        return view('post.edit', compact('post'));
    }
}
