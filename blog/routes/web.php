<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Strona główna bloga
Route::get('/', [PostController::class, 'index'])->name('home');

// Pojedynczy post
Route::get('/post/{slug}', [PostController::class, 'show'])->name('post.show');
