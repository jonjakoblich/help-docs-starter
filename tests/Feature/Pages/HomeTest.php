<?php

use App\Models\Article;
use App\Models\Category;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;

it('displays articles and categories', function () {
    Article::factory()->count(5)->create();
    Category::factory()->count(3)->create();

    get(route('home'))
        ->assertOk()
        ->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Home')
            ->has('articles',5)
            ->has('categories', 3)
    );
});
