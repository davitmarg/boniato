@extends('layouts.app')

@section('content')
<div class="box">
    <h2 style="text-align: center; margin-bottom: 20px;">Log in to Boniato</h2>

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>
        </div>

        <button type="submit" class="primary" style="width: 100%;">Log In</button>
    </form>

    <p style="text-align: center; margin-top: 20px; color: #777;">
        Don't have an account? <a href="{{ route('register') }}" style="color: #d35400;">Sign up</a>
    </p>

    @if ($errors->any())
    <div style="color: red; margin-top: 10px; text-align: center;">
        {{ $errors->first() }}
    </div>
    @endif
</div>
@endsection