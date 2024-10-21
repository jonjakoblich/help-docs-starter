<?php

use App\Models\Category;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;

it('displays a category with listing of articles', function () {
    $category = Category::factory()
                ->hasArticles(2)
                ->create();

    get(route('category.view', $category->slug))
        ->assertOk()
        ->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Category')
            ->where('name', $category->name)
            ->has('articles', 2)
            ->where('slug', $category->slug)
        );
});

// Extend test to ensure that only published articles are displayed