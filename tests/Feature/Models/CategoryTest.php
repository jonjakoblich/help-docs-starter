<?php

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Str;

uses()->group('models','category');

beforeEach(function() {
    $this->category = Category::factory()
        ->hasArticles(3)
        ->create();
});

it('has a name', function () {
    expect($this->category)->name
        ->not->toBeNull()
        ->toBeString();
});

it('has a slug', function () {
    expect($this->category)->slug
        ->not->toBeNull()
        ->toBeString()
        ->toBe(Str::slug($this->category->name));
});

it('can have a parent category', function () {
    $category = Category::factory()
        ->forParent()
        ->create();

    expect($category)->parent
        ->not->toBeNull()
        ->toBeInstanceOf(Category::class);
});

it('can be without a parent', function () {
    expect($this->category)->parent->toBeNull();
});

it('can have many children categories', function () {
    $category = Category::factory()
        ->hasChildren(3)
        ->create();
    
    expect($category)->children
        ->not->toBeNull()
        ->toBeIterable()
        ->each->toBeInstanceOf(Category::class);
});

it('can be without children', function () {
    expect($this->category)->children->toBeEmpty();
});

it('can have many articles', function () {
    expect($this->category)->articles
        ->not->toBeNull()
        ->toBeIterable()
        ->each->toBeInstanceOf(Article::class);
});
