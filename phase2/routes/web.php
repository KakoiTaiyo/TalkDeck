<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\GeminiController;
use App\Http\Controllers\Confirmfollows;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\HistoryController;

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
    Route::post('/gemini', [GeminiController::class, 'show'])->name('gemini.show');
    Route::get('/gemini', [GeminiController::class, 'show'])->name('gemini.show'); 
    Route::get('/search', [UserController::class, 'search'])->name('users.search');
});

Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
Route::post('/history/save', [HistoryController::class, 'saveHistory'])->name('history.save');


Route::get('/user/{id}/followings', [Confirmfollows::class, 'followings'])->name('profile.followings');
Route::get('/user/{id}/followers', [Confirmfollows::class, 'followers'])->name('profile.followers');

Route::get('/mypage/{id}', [MypageController::class, 'show'])->name('mypage');
Route::get('/mypage/{id}/followers', [Confirmfollows::class, 'followers'])->name('profile.followers');
Route::get('/mypage/{id}/followings', [Confirmfollows::class, 'followings'])->name('profile.followings');
require __DIR__ . '/auth.php';
