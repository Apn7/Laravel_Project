<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UploadController;

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



