<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SubscriberDashboardController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/subscriber/dashboard', [SubscriberDashboardController::class, 'index'])->name('subscriber.dashboard');
    Route::post('/subscriber/propose-article', [SubscriberDashboardController::class, 'proposeArticle'])->name('subscriber.propose.article');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
