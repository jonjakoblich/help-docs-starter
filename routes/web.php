<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleSearchController;
use App\Http\Controllers\CastHelpfulVoteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomePageController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePageController::class)->name('home');

Route::prefix('articles')
    ->name('article.')
    ->group(function(){
        Route::get('{article:slug}', ArticleController::class)->name('view');
        Route::post('{article:slug}/vote', CastHelpfulVoteController::class)->name('cast-vote');
});

Route::get('/category/{category:slug}', CategoryController::class)->name('category.view');

Route::post('/search', ArticleSearchController::class)->name('search.retrieve');
