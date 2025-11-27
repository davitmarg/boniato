@props(['post' => null])

<div class="box">
    <form action="{{ $post ? route('post.update', $post->id) : route('post.store') }}" method="POST">
        @csrf
        @if($post)
        @method('PUT')
        @endif

        <textarea name="content" placeholder="What is happening?!" style="{{ $post ? 'height: 150px;' : '' }}">{{ $post ? $post->content : '' }}</textarea>

        <div style="text-align: right; margin-top: 10px;">
            @if($post)
            <a href="{{ route('home') }}" style="margin-right: 10px; text-decoration: none; color: #555;">Cancel</a>
            @endif
            <button type="submit" class="primary">{{ $post ? 'Update Post' : 'Post' }}</button>
        </div>
    </form>
</div>