<?php

use App\Models\Article;
use Database\Seeders\DatabaseSeeder;

use function Pest\Laravel\post;
use function Pest\Laravel\seed;

beforeEach(function(){
    seed(DatabaseSeeder::class);

    $this->data = [
        's' => Article::first()->name,
    ];
});

it('returns search results in JSON', function () {
    $results = post(route('search.retrieve'), $this->data)
        ->assertSessionHasNoErrors()
        ->assertOk()
        ->assertJsonIsArray();

    //dd($results->json());
});

it('returns highlight data', function () {
    post(route('search.retrieve'), $this->data)
        ->assertSessionHasNoErrors()
        ->assertJson('results');
})->skip('Requires data from scoutMetadata. Pending PR https://github.com/laravel/scout/pull/868');

