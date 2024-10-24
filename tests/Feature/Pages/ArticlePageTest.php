<?php

use App\Models\Article;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;

it('displays an article', function () {
    $article = Article::factory()
                ->hasCategories(2)
                ->create();

    Article::factory()
        ->count(3)
        ->published()
        ->sequence(
            ['order' => 5],
            ['order' => 20],
            ['order' => 30],
        )
        ->create();

    get(route('article.view', $article->slug))
        ->assertOk()
        ->assertInertia(fn(AssertableInertia $page) => $page
            ->component('Article')
            ->has('article', fn(AssertableInertia $page) => $page
                ->where('name', $article->name)
                ->where('content', $article->content)
                ->has('categories')
                ->where('updated_at', $article->updated_at->toJSON())
                ->where('slug', $article->slug)
            )
            ->has('navigation',3)
            ->has('previous', fn(AssertableInertia $page) => $page
                ->where('order',5)
                ->has('name')
                ->has('slug')
            )
            ->has('next', fn(AssertableInertia $page) => $page
                ->where('order',20)
                ->has('name')
                ->has('slug')
            )
        );
});
