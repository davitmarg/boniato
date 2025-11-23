<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedController;

Route::get('/', [FeedController::class, 'index'])->name('home');
Route::post('/post', [FeedController::class, 'storePost'])->name('post.store');
Route::post('/comment/{postId}', [FeedController::class, 'storeComment'])->name('comment.store');
Route::post('/like/{postId}', [FeedController::class, 'toggleLike'])->name('like.toggle');
