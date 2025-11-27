<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boniato</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }

        header {
            background-color: #ffffff;
            padding: 0 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #d35400;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo:hover {
            color: #e67e22;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 0 15px;
        }

        .box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            margin-left: 20px;
        }

        .nav-link:hover {
            color: #000;
        }

        textarea {
            width: 100%;
            height: 80px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            resize: vertical;
            box-sizing: border-box;
            font-family: inherit;
        }

        button.primary {
            background-color: #d35400;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        button.primary:hover {
            background-color: #e67e22;
        }

        button.link {
            background: none;
            border: none;
            color: #555;
            cursor: pointer;
            padding: 5px;
        }

        button.link:hover {
            color: #d35400;
        }

        .post-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 0.9rem;
            color: #777;
        }

        .post-header a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .post-content {
            font-size: 1rem;
            line-height: 1.5;
            color: #1a1a1a;
            margin-bottom: 15px;
        }

        .post-footer {
            border-top: 1px solid #eee;
            padding-top: 10px;
            display: flex;
            gap: 15px;
        }

        .comment-section {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            background-color: #fafafa;
            padding: 15px;
            border-radius: 6px;
        }

        .single-comment {
            margin-bottom: 10px;
            font-size: 0.9rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>

    <header>
        <a href="{{ route('home') }}" class="logo">
            <span>🍠</span> Boniato
        </a>

        <nav>
            @auth
            <a href="{{ route('profile.show', auth()->id()) }}" class="nav-link">
                👤 {{ auth()->user()->name }}
            </a>

            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="nav-link" style="background: none; border: none; cursor: pointer; font-size: 1rem; font-family: inherit;">Logout</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="nav-link">Log In</a>
            <a href="{{ route('register') }}" class="nav-link" style="color: #d35400;">Sign Up</a>
            @endauth
        </nav>
    </header>

    <div class="container">
        @yield('content')
    </div>

</body>

</html>