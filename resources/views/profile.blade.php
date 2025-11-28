@extends('layouts.app')

@section('content')

<div class="box" style="text-align: center;">
    <div style="width: 80px; height: 80px; background: #d35400; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 10px;">
        {{ substr($user->name, 0, 1) }}
    </div>

    <div id="profile-name-display" style="display: flex; justify-content: center; align-items: center; gap: 10px;">
        <h2 style="margin: 0;">{{ $user->name }}</h2>
        @if(Auth::id() === $user->id)
        <button onclick="toggleProfileEdit()" style="background: none; border: none; cursor: pointer; font-size: 1.2rem; color: #777;" title="Edit Name">✎</button>
        @endif
    </div>

    @if(Auth::id() === $user->id)
    <form id="profile-name-form" action="{{ route('user.update', $user->id) }}" method="POST" style="display: none; margin-bottom: 10px;">
        @csrf
        @method('PUT')
        <div style="display: flex; justify-content: center; gap: 5px; max-width: 300px; margin: 0 auto;">
            <input type="text" name="name" value="{{ $user->name }}" autocomplete="given-name" style="padding: 5px; border: 1px solid #ddd; border-radius: 4px; flex: 1; font-size: 1.2rem; text-align: center;">
            <button type="submit" class="primary" style="padding: 5px 10px;">Save</button>
            <button type="button" onclick="toggleProfileEdit()" style="border: 1px solid #ccc; background: white; cursor: pointer; border-radius: 4px; padding: 5px 10px;">Cancel</button>
        </div>
    </form>
    @endif

    <p style="color: #777; margin-top: 10px;">Member since {{ $user->created_at->format('M Y') }}</p>
</div>

<script>
    function toggleProfileEdit() {
        var display = document.getElementById('profile-name-display');
        var form = document.getElementById('profile-name-form');

        if (display.style.display === 'none') {
            display.style.display = 'flex';
            form.style.display = 'none';
        } else {
            display.style.display = 'none';
            form.style.display = 'block';
        }
    }
</script>

<h3 style="margin: 20px 0 10px;">Posts by {{ $user->name }}</h3>

@foreach($posts as $post)
<x-post-card :post="$post" />
@endforeach

@endsection