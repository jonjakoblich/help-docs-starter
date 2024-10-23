<?php

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;

use function Pest\Laravel\seed;

beforeEach(function(){
    test()->assertDatabaseCount(Article::class, 0);
    test()->assertDatabaseCount(Category::class, 0);
    test()->assertDatabaseCount(User::class, 0);

    seed(DatabaseSeeder::class);
});

it('seeds the database with 3 categories', function () {
    test()->assertDatabaseCount(Category::class, 3);
});

it('seeds the database with 10 published articles', function () {
    test()->assertDatabaseCount(Article::class, 10);
});

it('seeds the database with 5 featured articles', function () {
    $articles = Article::where('featured', true)->get();

    expect($articles->count())->toBe(5);
});

it('seeds the database with 3 featured categories', function () {
    $categories = Category::where('featured', true);

    expect($categories->count())->toBe(3);
});

it('creates a test user', function () {
    test()->assertDatabaseHas(User::class, [
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);
});
