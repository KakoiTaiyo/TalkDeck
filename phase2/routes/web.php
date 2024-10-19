<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', [UserController::class, 'search'])->name('users.search');
Route::middleware('auth')->group(function () {
    Route::post('/follow/{id}', [FollowController::class, 'follow'])->name('follow');
    Route::post('/unfollow/{id}', [FollowController::class, 'unfollow'])->name('unfollow');
});
Route::get('/user/{id}', [UserController::class, 'getUser'])->name('user.get');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/search', [UserController::class, 'search'])->name('users.search');
    Route::get('/user/{id}', [UserController::class, 'getUser'])->name('user.get');
});


require __DIR__ . '/auth.php';
