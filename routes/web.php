<?php

use App\Http\Controllers\AuthManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ProfileController;

Route::get('/',[HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');

Route::get('/register', [AuthManager::class, 'register'])->name('register');
Route::post('/register', [AuthManager::class, 'registerPost'])->name('register.post');

Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

Route::post('/upload', [UploadController::class, 'upload'])->name('upload');

Route::post('/like', [HomeController::class, 'like'])->name('like');

Route::post('/comment', [HomeController::class, 'comment'])->name('comment');

Route::post('/deletMeme', [HomeController::class, 'deleteMeme'])->name('deleteMeme');

Route::post('/deletComment', [HomeController::class, 'deleteComment'])->name('deleteComment');

Route::post('/editMeme', [HomeController::class, 'editMeme'])->name('editMeme');

Route::post('/editMemeView', [HomeController::class, 'editMemeView'])->name('editMemeView');

Route::match(['get', 'post'], '/profile/{username}', [ProfileController::class, 'profile'])->name('profile');

Route::post('/follow', [ProfileController::class, 'follow'])->name('follow');

Route::get('/my_feed', [HomeController::class, 'myFeed'])->name('my_feed');

Route::get('/meme/{id}', [HomeController::class, 'meme'])->name('meme');

Route::post('/uploaddp', [UploadController::class, 'uploadDp'])->name('uploaddp');

