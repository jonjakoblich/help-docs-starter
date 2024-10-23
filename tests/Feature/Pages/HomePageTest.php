<?php

use App\Models\Article;
use App\Models\Category;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;

it('displays featured published articles and categories', function () {
    Article::factory()->count(5)->create();
    
    Article::factory()->count(5)
        ->featured()
        ->published()
        ->create();
    
    Category::factory()->count(3)
        ->forParent()
        ->featured()
        ->create();

    get(route('home'))
        ->assertOk()
        ->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Home')
            ->has('featuredArticles',5,fn(AssertableInertia $page) => $page
                ->has('name')
                ->has('slug')
                ->has('order')
            )
            ->has('featuredCategories', 3, fn(AssertableInertia $page) => $page
                ->has('name')
                ->has('slug')
                ->has('parent')
            )
    );
});
