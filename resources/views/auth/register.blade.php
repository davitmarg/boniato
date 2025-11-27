@extends('layouts.app')

@section('content')
<div class="box">
    <h2 style="text-align: center; margin-bottom: 20px;">Join Boniato</h2>

    <form action="{{ route('register.submit') }}" method="POST">
        @csrf

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Name</label>
            <input type="text" name="name" placeholder="Your Name" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Password</label>
            <input type="password" name="password" placeholder="Create a password" required>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Confirm Password</label>
            <input type="password" name="password_confirmation" placeholder="Repeat password" required>
        </div>

        <button type="submit" class="primary" style="width: 100%;">Sign Up</button>
    </form>

</div>
@endsection