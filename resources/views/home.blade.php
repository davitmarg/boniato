<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boniato Feed</title>
    <!-- Simple CSS for layout -->
    <style>
        body {
            font-family: sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #f0f2f5;
        }

        .box {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        textarea {
            width: 100%;
            height: 60px;
            margin-bottom: 10px;
        }

        button {
            background: #1877f2;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .post-meta {
            color: #65676b;
            font-size: 0.9em;
            margin-bottom: 10px;
        }

        .comment {
            background: #f0f2f5;
            padding: 8px;
            border-radius: 8px;
            margin-top: 5px;
            font-size: 0.9em;
        }

        .like-btn {
            background: none;
            border: 1px solid #ddd;
            color: #333;
        }
    </style>
</head>

<body>

    <h1>🍠 Boniato Stream</h1>

    <!-- Create Post Form -->
    <div class="box">
        <form action="{{ route('post.store') }}" method="POST">
            @csrf
            <textarea name="content" placeholder="What's on your mind?"></textarea>
            <button type="submit">Post</button>
        </form>
    </div>

    <!-- Feed Loop -->
    @foreach($posts as $post)
    <div class="box">
        <div class="post-meta">
            <strong>{{ $post->user->username }}</strong> • {{ $post->created_at->diffForHumans() }}
        </div>

        <p>{{ $post->content }}</p>

        <hr style="border: 0; border-top: 1px solid #eee;">

        <!-- Actions -->
        <form action="{{ route('like.toggle', $post->id) }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit" class="like-btn">
                {{ $post->likes->contains('id', 1) ? '❤️ Unlike' : '🤍 Like' }}
                ({{ $post->likes->count() }})
            </button>
        </form>

        <!-- Comments Section -->
        <div style="margin-top: 15px;">
            @foreach($post->comments as $comment)
            <div class="comment">
                <strong>{{ $comment->user->username }}:</strong> {{ $comment->content }}
            </div>
            @endforeach

            <!-- Add Comment Form -->
            <form action="{{ route('comment.store', $post->id) }}" method="POST" style="margin-top: 10px;">
                @csrf
                <input type="text" name="content" placeholder="Write a comment..." style="width: 70%;">
                <button type="submit" style="padding: 4px 8px; font-size: 0.8em;">Reply</button>
            </form>
        </div>
    </div>
    @endforeach

</body>

</html>