<?php

use App\Http\Controllers\ClapController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Support\Facades\Route;

Route::get('@{user:username}', [PublicProfileController::class, 'show'])->name('profile.show');
Route::get('/', [PostController::class, 'index'])->name('dashboard');
Route::get('@{username}/{post:slug}', [PostController::class, 'show'])->name('post.show');
Route::get('category/{category}', [PostController::class, 'category'])->name('post.byCategory');

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('post/create', [PostController::class, 'create'])->name('post.create');
    Route::get('post/{post:slug}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('post/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('post/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    Route::get('my-posts', [PostController::class, 'myPosts'])->name('myPosts');
    Route::post('post', [PostController::class, 'store'])->name('post.store');
    Route::post('follow/{user}', [FollowController::class, 'followUnfollow'])->name('follow');
    Route::post('claps/{post}', [ClapController::class, 'claps'])->name('claps');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
