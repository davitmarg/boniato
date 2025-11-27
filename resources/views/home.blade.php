@extends('layouts.app')

@section('content')

@auth
<div class="box">
    <form action="{{ route('post.store') }}" method="POST">
        @csrf
        <textarea name="content" placeholder="What is happening?!"></textarea>
        <div style="text-align: right; margin-top: 10px;">
            <button type="submit" class="primary">Post</button>
        </div>
    </form>
</div>
@endauth

@foreach($posts as $post)
<div class="box">
    <div class="post-header">
        <div>
            <a href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->name }}</a>
            <span>&middot; {{ $post->created_at->diffForHumans() }}</span>
        </div>
    </div>

    <div class="post-content">
        {{ $post->content }}
    </div>

    <div class="post-footer">
        <form
            action="{{ route('like.toggle', $post->id) }}"
            method="POST"
            style="display:inline;"
            id="like-form-{{ $post->id }}"
            hx-post="{{ route('like.toggle', $post->id) }}"
            hx-select="#like-form-{{ $post->id }}"
            hx-swap="outerHTML">
            @csrf
            <button type="submit" class="link">
                {{ $post->likes->contains('id', auth()->id()) ? '❤️' : '🤍' }} {{ $post->likes->count() }}
            </button>
        </form>

        <a href="{{ route('post.show', $post->id) }}" class="link" style="text-decoration: none; font-size: 0.9rem;">
            💬 {{ $post->comments->count() }} Comments
        </a>
    </div>
</div>
@endforeach

@endsection