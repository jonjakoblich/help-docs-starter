<?php

use App\Models\Article;
use App\Models\Category;
use App\States\ArticleStatus;
use App\States\Draft;
use Illuminate\Support\Str;

uses()->group('models','article');

beforeEach(function(){
    $this->article = Article::factory()
        ->hasCategories(3)
        ->create();
});

it('has a name', function () {
    expect($this->article)->name
        ->not->toBeNull()
        ->toBeString();
});

it('has long form content', function () {
    expect($this->article)->content
        ->not->toBeNull()
        ->toBeString();
});

it('has an author', function () {
    expect($this->article)->author
        ->not->toBeNull()
        ->toBeNumeric();
});

it('has categories', function () {
    expect($this->article)->categories
        ->toBeIterable()
        ->each->toBeInstanceOf(Category::class);
});

it('has a slug', function () {
    expect($this->article)->slug
        ->not->toBeNull()
        ->toBeString()
        ->toBe(Str::slug($this->article->name));
});

it('has a status', function () {
    expect($this->article)->status
        ->not->toBeNull()
        ->toBeInstanceOf(ArticleStatus::class);
});

it('has a default status of draft', function () {
    expect($this->article)->status->toBeInstanceOf(Draft::class);
});

it('has an order property which defaults to 10', function () {
    expect($this->article)->order
        ->not->toBeNull()
        ->toBeNumeric
        ->toBe(10);
});
