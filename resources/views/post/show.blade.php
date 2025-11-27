@extends('layouts.app')

@section('content')

<x-post-card :post="$post" />

<div class="box">
    <div class="comment-section">
        <h3>Comments</h3>

        @foreach($post->comments as $comment)
        <div class="single-comment" style="margin-bottom: 15px;">
            <div id="comment-display-{{ $comment->id }}" style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}
                </div>

                @if(Auth::id() === $comment->user_id)
                <div style="font-size: 0.8rem; min-width: 80px; text-align: right;">
                    <button class="edit-btn" data-comment-id="{{ $comment->id }}" style="background: none; border: none; color: #1877f2; cursor: pointer; padding: 0; margin-right: 5px; font-family: inherit; font-size: inherit;">Edit</button>

                    <form action="{{ route('comment.delete', $comment->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: red; cursor: pointer; padding: 0; font-size: 0.8rem;">X</button>
                    </form>
                </div>
                @endif
            </div>

            @if(Auth::id() === $comment->user_id)
            <form id="comment-edit-{{ $comment->id }}" action="{{ route('comment.update', $comment->id) }}" method="POST" style="display: none; margin-top: 5px;">
                @csrf
                @method('PUT')
                <div style="display: flex; gap: 5px;">
                    <input type="text" name="content" value="{{ $comment->content }}" style="flex: 1; padding: 5px;">
                    <button type="submit" class="primary" style="font-size: 0.8rem; padding: 5px 10px;">Save</button>
                    <button type="button" class="cancel-btn" data-comment-id="{{ $comment->id }}" style="border: 1px solid #ccc; background: white; cursor: pointer; border-radius: 4px; padding: 5px 10px; font-size: 0.8rem;">Cancel</button>
                </div>
            </form>
            @endif
        </div>
        @endforeach

        <form action="{{ route('comment.store', $post->id) }}" method="POST" style="margin-top: 20px;">
            @csrf
            <input type="text" name="content" placeholder="Write a reply..." required>
            <button type="submit" class="primary" style="font-size: 0.8rem;">Reply</button>
        </form>
    </div>
</div>

<script>
    function toggleEdit(id) {
        var display = document.getElementById('comment-display-' + id);
        var form = document.getElementById('comment-edit-' + id);

        if (display.style.display === 'none') {
            display.style.display = 'flex';
            form.style.display = 'none';
        } else {
            display.style.display = 'none';
            form.style.display = 'block';
        }
    }

    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            toggleEdit(this.dataset.commentId);
        });
    });

    document.querySelectorAll('.cancel-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            toggleEdit(this.dataset.commentId);
        });
    });
</script>

@endsection