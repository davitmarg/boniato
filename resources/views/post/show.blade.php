@extends('layouts.app')

@section('content')

<div class="box">
    <div class="post-header">
        <a href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->name }}</a>
        <span>{{ $post->created_at->diffForHumans() }}</span>
    </div>

    <div class="post-content" style="font-size: 1.2rem;">
        {{ $post->content }}
    </div>

    <div class="post-footer">
        <form action="{{ route('like.toggle', $post->id) }}" method="POST">
            @csrf
            <button type="submit" class="link">
                {{ $post->likes->contains('id', 1) ? '❤️' : '🤍' }} {{ $post->likes->count() }}
            </button>
        </form>
    </div>

    <div class="comment-section">
        <h3>Comments</h3>

        @foreach($post->comments as $comment)
        <div class="single-comment">
            <strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}
        </div>
        @endforeach

        <form action="{{ route('comment.store', $post->id) }}" method="POST" style="margin-top: 20px;">
            @csrf
            <input type="text" name="content" placeholder="Write a reply..." required>
            <button type="submit" class="primary" style="font-size: 0.8rem;">Reply</button>
        </form>
    </div>
</div>

@endsection