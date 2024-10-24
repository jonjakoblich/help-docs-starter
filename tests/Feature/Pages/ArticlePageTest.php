<?php

use App\Models\Article;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\get;

it('displays an article', function () {
    $article = Article::factory()
                ->hasCategories(2)
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
            ->has('navigation')
        );
});
