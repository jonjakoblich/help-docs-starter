<?php

use App\Models\Article;
use App\Models\Category;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;

it('displays a category with listing of published articles', function () {
    $category = Category::factory()
                ->has(Article::factory()
                    ->count(2)
                    ->published()
                )
                ->hasArticles(2)
                ->create();

    get(route('category.view', $category->slug))
        ->assertOk()
        ->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Category')
            ->where('name', $category->name)
            ->has('articles', 2, fn(AssertableInertia $page) => $page
                ->has('name')
                ->has('slug')
                ->has('order')
            )
            ->where('slug', $category->slug)
        );
});

it('displays child categories and their articles', function () {
    $category = Category::factory()
        ->has(Article::factory()
            ->count(2)
            ->published()
        )
        ->has(Category::factory()
            ->has(Article::factory()
                ->count(3)
                ->published()
            )
            , 'children'
        )
        ->create();

    get(route('category.view', $category->slug))
        ->assertOk()
        ->assertInertia(fn(AssertableInertia $page) => $page
            ->has('children', 1, fn(AssertableInertia $page) => $page
                ->has('articles', 3, fn(AssertableInertia $page) => $page
                    ->has('name')
                    ->has('slug')
                    ->has('order')
                )
                ->has('name')
            )
        );
});
