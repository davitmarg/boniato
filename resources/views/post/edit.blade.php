@extends('layouts.app')

@section('content')
<div class="box">
    <h2>Edit Post</h2>
    <form action="{{ route('post.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <textarea name="content" style="height: 150px;">{{ $post->content }}</textarea>
        <div style="margin-top: 10px;">
            <button type="submit" class="primary">Update Post</button>
            <a href="{{ route('home') }}" style="margin-left: 10px; text-decoration: none; color: #555;">Cancel</a>
        </div>
    </form>
</div>
@endsection