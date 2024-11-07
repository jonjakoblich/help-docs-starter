<?php

use App\Models\Article;
use App\States\Published;
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
    post(route('search.retrieve'), $this->data)
        ->assertSessionHasNoErrors()
        ->assertOk()
        ->assertJsonIsArray();
});

it('returns highlight data', function () {
    post(route('search.retrieve'), $this->data)
        ->assertSessionHasNoErrors()
        ->assertJson('results');
})->skip('Requires data from scoutMetadata. Pending PR https://github.com/laravel/scout/pull/868');

it('shows only published posts', function () {
    $article = Article::factory()->state(['name' => 'XyzJJJXyz'])->create();

    $data = [
        's' => $article->name,
    ];

    post(route('search.retrieve'), $data)
        ->assertSessionHasNoErrors()
        ->assertOk()
        ->assertSimilarJson(
            Article::whereState('status',Published::class)
                ->get()
                ->select('name','slug')
                ->toArray()
        )
        ->assertJsonMissingExact([
            'name' => $article->name,
            'slug' => $article->slug,
        ]);
});
