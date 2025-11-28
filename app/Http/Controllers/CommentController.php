<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
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
}
