<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleSearchController;
use App\Http\Controllers\CastHelpfulVoteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/* Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
}); */

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', HomePageController::class)->name('home');

Route::get('/article/{article:slug}', ArticleController::class)->name('article.view');
Route::post('/article/{article:slug}/vote', CastHelpfulVoteController::class)->name('article.cast-vote');

Route::get('/category/{category:slug}', CategoryController::class)->name('category.view');

Route::post('/search', ArticleSearchController::class)->name('search.retrieve');

require __DIR__.'/auth.php';
