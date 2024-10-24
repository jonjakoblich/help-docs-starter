<?php

use App\Models\Article;
use Database\Seeders\DatabaseSeeder;

use function Pest\Laravel\post;
use function Pest\Laravel\seed;

it('returns search results in JSON', function () {
    seed(DatabaseSeeder::class);

    $data = [
        's' => Article::first()->name,
    ];

    post(route('search.retrieve'), $data)
        ->assertSessionHasNoErrors()
        ->assertOk()
        ->assertJsonIsArray();
});

