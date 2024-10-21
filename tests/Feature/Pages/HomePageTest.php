<?php

use App\Models\Article;
use App\Models\Category;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;

it('displays published articles and categories', function () {
    Article::factory()->count(5)->create();
    Article::factory()->count(5)->published()->create();
    Category::factory()->count(3)
        ->forParent()
        ->create();

    get(route('home'))
        ->assertOk()
        ->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Home')
            ->has('articles',5,fn(AssertableInertia $page) => $page
                ->has('name')
                ->has('slug')
                ->has('order')
            )
            ->has('categories', 4, fn(AssertableInertia $page) => $page
                ->has('name')
                ->has('slug')
                ->has('parent')
            )
    );
});
