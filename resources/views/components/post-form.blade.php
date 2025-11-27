@props(['post' => null, 'placeholder' => 'What is happening?!'])

<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

<div class="box">
    <form
        action="{{ $post ? route('post.update', $post->id) : route('post.store') }}"
        method="POST"
        id="post-form-{{ $post ? $post->id : 'create' }}">
        @csrf
        @if($post)
        @method('PUT')
        @endif

        <input type="hidden" name="content" id="hidden-content-{{ $post ? $post->id : 'create' }}">

        <div id="editor-container-{{ $post ? $post->id : 'create' }}" style="height: 150px; background: white;">
            {!! $post ? $post->content : '' !!}
        </div>

        <div style="text-align: right; margin-top: 10px;">
            @if($post)
            <a href="{{ route('home') }}" style="margin-right: 10px; text-decoration: none; color: #555;">Cancel</a>
            @endif
            <button type="submit" class="primary">{{ $post ? 'Update Post' : 'Post' }}</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<script>
    (function() {
        var uniqueId = "{{ $post ? $post->id : 'create' }}";
        var editorId = "#editor-container-" + uniqueId;
        var formId = "#post-form-" + uniqueId;
        var inputId = "hidden-content-" + uniqueId;

        // Prevent initializing twice if script runs multiple times
        if (!document.querySelector(editorId).classList.contains('ql-container')) {
            var quill = new Quill(editorId, {
                theme: 'snow',
                placeholder: "{{ $placeholder }}"
            });

            var form = document.querySelector(formId);
            form.onsubmit = function() {
                var content = document.querySelector("#" + inputId);
                // Save HTML content to hidden input
                content.value = quill.root.innerHTML;
            };
        }
    })();
</script>