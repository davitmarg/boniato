@extends('layouts.app')

@section('content')

<div class="box">
    <div class="post-header">
        <a href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->name }}</a>
        <span>{{ $post->created_at->diffForHumans() }}</span>

        @if(auth()->id() === $post->user_id)
        <div style="font-size: 0.8rem; margin-left: auto;">
            <a href="{{ route('post.edit', $post->id) }}" style="text-decoration: none; color: #1877f2; margin-right: 10px;">Edit</a>
            <form action="{{ route('post.delete', $post->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete post?');">
                @csrf
                @method('DELETE')
                <button type="submit" style="background: none; border: none; color: red; cursor: pointer; padding: 0;">Delete</button>
            </form>
        </div>
        @endif
    </div>

    <div class="post-content" style="font-size: 1.2rem;">
        {{ $post->content }}
    </div>

    <div class="post-footer">
        <form action="{{ route('like.toggle', $post->id) }}" method="POST">
            @csrf
            <button type="submit" class="link">
                {{ $post->likes->contains('user_id', Auth::id()) ? '❤️' : '🤍' }} {{ $post->likes->count() }}
            </button>
        </form>
    </div>

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
                    <button onclick="toggleEdit({{ $comment->id }})" style="background: none; border: none; color: #1877f2; cursor: pointer; padding: 0; margin-right: 5px; font-family: inherit; font-size: inherit;">Edit</button>

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
                    <button type="button" onclick="toggleEdit({{ $comment->id }})" style="border: 1px solid #ccc; background: white; cursor: pointer; border-radius: 4px; padding: 5px 10px; font-size: 0.8rem;">Cancel</button>
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
    </script>
</div>

@endsection