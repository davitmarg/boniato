@foreach($posts as $post)
<div
    @if ($loop->last && $posts->hasMorePages())
    hx-get="{{ $posts->nextPageUrl() }}"
    hx-trigger="revealed"
    hx-swap="afterend"
    @endif
    >
    <x-post-card :post="$post" />
</div>
@endforeach