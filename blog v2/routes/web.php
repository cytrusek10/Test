<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\AdminPostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/post/{slug}', [PostController::class, 'show'])->name('post.show');

Route::prefix('admin/posts')->middleware('auth')->group(function () {
    Route::get('/', [AdminPostController::class, 'index'])->name('admin.posts.index');
    Route::get('/create', [AdminPostController::class, 'create'])->name('admin.posts.create');
    Route::post('/', [AdminPostController::class, 'store'])->name('admin.posts.store');
    Route::get('/{post}/edit', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
    Route::put('/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');
    Route::delete('/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.destroy');
    Route::post('/preview', [AdminPostController::class, 'preview'])->name('admin.posts.preview');
});

