<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/posts');

// 1. Route resource + named routes (posts.index, posts.create, posts.store,
//    posts.show, posts.edit, posts.update, posts.destroy)
Route::resource('posts', PostController::class);

// Bonus: restore soft delete
Route::patch('posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
