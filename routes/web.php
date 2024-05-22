<?php

use App\Http\Controllers\AuthManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;

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

Route::get('/editMemeView/{id}', [HomeController::class, 'editMemeView'])->name('editMemeView');

Route::post('/editMeme', [HomeController::class, 'editMeme'])->name('editMeme');

Route::match(['get', 'post'], '/profile/{username}', [ProfileController::class, 'profile'])->name('profile');

Route::post('/follow', [ProfileController::class, 'follow'])->name('follow');

Route::get('/my_feed', [HomeController::class, 'myFeed'])->name('my_feed');

Route::get('/meme/{id}', [HomeController::class, 'meme'])->name('meme');

Route::post('/uploaddp', [UploadController::class, 'uploadDp'])->name('uploaddp');

Route::match(['get', 'post'],'/editProfileView/{username}', [ProfileController::class, 'editProfileView'])->name('editProfileView');

Route::post('/editProfile', [ProfileController::class, 'editProfile'])->name('editProfile');

Route::post('/editPass', [ProfileController::class, 'editPass'])->name('editPass');

Route::get('/search_users', [ProfileController::class, 'searchUsers'])->name('search_users');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

Route::get('/notifications/{notification}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

Route::get('/trending', [HomeController::class, 'trendingMemes'])->name('trending');

Route::get('/report', [HomeController::class, 'report'])->name('report');

Route::post('/report', [HomeController::class, 'reportPost'])->name('report.post');

Route::get('/memeContext', [HomeController::class, 'memeContext'])->name('memeContext');

// Admin routes
Route::middleware(['auth','admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/reports',[AdminController::class,'reports'])->name('admin.reports');
    Route::post('/admin/deleteReport',[AdminController::class,'deteleReport'])->name('admin.deleteReport');
    Route::post('/admin/deleteUser',[AdminController::class,'deleteUser'])->name('admin.deleteUser');
    Route::post('/admin/makeAdmin',[AdminController::class,'makeAdmin'])->name('admin.makeAdmin');
    Route::get('/admin/context', [AdminController::class, 'context'])->name('admin.context');
    Route::post('/admin/uploadContext', [AdminController::class, 'uploadContext'])->name('admin.uploadContext');
    // Add more admin routes as needed
});

//





