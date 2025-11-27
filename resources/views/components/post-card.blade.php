@props(['post'])

<div class="box">
    <div class="post-header">
        <div>
            <a href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->name }}</a>
            <span>&middot; {{ $post->created_at->diffForHumans() }}</span>
        </div>

        @if(Auth::id() === $post->user_id)
        <div style="font-size: 0.8rem;">
            <a href="{{ route('post.edit', $post->id) }}" style="text-decoration: none; color: #1877f2; margin-right: 10px;">Edit</a>
            <form action="{{ route('post.delete', $post->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" style="background: none; border: none; color: red; cursor: pointer; padding: 0;">Delete</button>
            </form>
        </div>
        @endif
    </div>

    <div class="post-content">
        {!! $post->content !!}
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
                {{ $post->likes->contains('id', Auth::id()) ? '❤️' : '🤍' }} {{ $post->likes->count() }} Likes
            </button>
        </form>

        <a href="{{ route('post.show', $post->id) }}" class="link" style="text-decoration: none; font-size: 0.9rem; margin-left: 15px;">
            💬 {{ $post->comments->count() }} Comments
        </a>
    </div>
</div>