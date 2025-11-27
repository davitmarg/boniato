<form
    action="{{ route('like.toggle', $post->id) }}"
    method="POST"
    style="display:inline;"
    id="like-form-{{ $post->id }}"
    hx-post="{{ route('like.toggle', $post->id) }}"
    hx-swap="outerHTML">
    @csrf
    <button type="submit" class="link">
        {{ $post->likes->contains('id', Auth::id()) ? '❤️' : '🤍' }} {{ $post->likes->count() }} Likes
    </button>
</form>