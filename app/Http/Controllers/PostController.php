<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
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

    public function editPost($id)
    {
        $post = Post::findOrFail($id);

        if (Auth::id() !== $post->user_id) {
            abort(403);
        }

        return view('post.edit', compact('post'));
    }
}
