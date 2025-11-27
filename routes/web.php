<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\AuthController;

// Public Routes
Route::get('/', [FeedController::class, 'index'])->name('home');
Route::get('/user/{id}', [FeedController::class, 'showProfile'])->name('profile.show');
Route::get('/post/{id}', [FeedController::class, 'showPost'])->name('post.show');

// (Only accessible if NOT logged in)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// (Only accessible if logged in)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/post', [FeedController::class, 'storePost'])->name('post.store');
    Route::post('/comment/{postId}', [FeedController::class, 'storeComment'])->name('comment.store');
    Route::post('/like/{postId}', [FeedController::class, 'toggleLike'])->name('like.toggle');
});
