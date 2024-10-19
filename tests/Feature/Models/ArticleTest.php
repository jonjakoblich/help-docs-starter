<?php

use App\Models\Article;
use App\Models\Category;
use App\States\Archived;
use App\States\ArticleStatus;
use App\States\Draft;
use App\States\Hidden;
use App\States\Published;
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

it('has statuses of draft published hidden and archived', function () {
    $states = Article::getStatesFor('status')->toArray();

    expect($states)->toEqualCanonicalizing([
        'App\States\Draft',
        'App\States\Published',
        'App\States\Hidden',
        'App\States\Archived',
    ]);
});

it('has a default status of draft', function () {
    expect($this->article)->status->toBeInstanceOf(Draft::class);
});

it('can transition from draft to any other status', function () {
    expect($this->article->status)
        ->canTransitionTo(Published::class)->toBeTrue()
        ->canTransitionTo(Archived::class)->toBeTrue()
        ->canTransitionTo(Hidden::class)->toBeTrue();
})->skip('Waiting on PR265 in spatie/laravel-model-states');

it('can transition from published to any other status', function () {
    $this->article->status->transitionTo(Published::class);

    expect($this->article->status)
        ->canTransitionTo(Draft::class)->toBeTrue()
        ->canTransitionTo(Archived::class)->toBeTrue()
        ->canTransitionTo(Hidden::class)->toBeTrue();
})->skip('Waiting on PR265 in spatie/laravel-model-states');

it('can transition from archived to any other status', function () {
    $this->article->status->transitionTo(Archived::class);

    expect($this->article->status)
        ->canTransitionTo(Draft::class)->toBeTrue()
        ->canTransitionTo(Published::class)->toBeTrue()
        ->canTransitionTo(Hidden::class)->toBeTrue();
})->skip('Waiting on PR265 in spatie/laravel-model-states');

it('can transition from hidden to any other status', function () {
    $this->article->status->transitionTo(Hidden::class);

    expect($this->article->status)
        ->canTransitionTo(Draft::class)->toBeTrue()
        ->canTransitionTo(Archived::class)->toBeTrue()
        ->canTransitionTo(Published::class)->toBeTrue();
})->skip('Waiting on PR265 in spatie/laravel-model-states');

it('has an order property which defaults to 10', function () {
    expect($this->article)->order
        ->not->toBeNull()
        ->toBeNumeric
        ->toBe(10);
});
