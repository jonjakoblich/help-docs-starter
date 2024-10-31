<?php

use Illuminate\Support\Facades\Route;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;

uses()->group('errors');

it('shows a custom 404 page', function () {
    get(route('article.view','nonexistent-slug'))
        ->assertNotFound()
        ->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Errors/404')
        );
});

it('shows a custom 503 page', function () {
    Route::get('/fake-endpoint', fn() => abort(503, 'Service Unavailable'));

    get('/fake-endpoint')
        ->assertServiceUnavailable()
        ->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Errors/503')
        );
});
