@extends('layouts.app')

@section('content')

<div class="box" style="text-align: center;">
    <div style="width: 80px; height: 80px; background: #d35400; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 10px;">
        {{ substr($user->name, 0, 1) }}
    </div>
    <h2>{{ $user->name }}</h2>
    <p style="color: #777;">Member since {{ $user->created_at->format('M Y') }}</p>
</div>

<h3 style="margin: 20px 0 10px;">Posts by {{ $user->name }}</h3>

@foreach($posts as $post)
<div class="box">
    <div class="post-header">
        <span>{{ $post->created_at->diffForHumans() }}</span>
    </div>
    <div class="post-content">
        {{ $post->content }}
    </div>
    <div class="post-footer">
        <span>❤️ {{ $post->likes->count() }} Likes</span>
        <a href="{{ route('post.show', $post->id) }}" style="text-decoration: none; color: #555; margin-left: 15px;">
            💬 {{ $post->comments->count() }} Comments
        </a>
    </div>
</div>
@endforeach

@endsection