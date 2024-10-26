<?php

use App\Models\Article;
use App\Models\HelpfulVote;
use App\Models\User;
use Inertia\Testing\AssertableInertia;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

describe('for guest users', function() {
    it('displays a published article', function () {
        $article = Article::factory()
                    ->published()
                    ->hasCategories(2)
                    ->hasVotes(4)
                    ->create();
    
        Article::factory()
            ->count(3)
            ->hasCategories(1)
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
                ->has('navigation', 5, fn(AssertableInertia $page) => $page
                    ->has('name')
                    ->has('articles', 1, fn(AssertableInertia $page) => $page
                        ->has('name')
                        ->has('slug')
                    )
                )
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
                ->has('helpfulMetrics', fn(AssertableInertia $page) => $page
                    ->where('totalVotes', 4)
                    ->where('foundHelpful', HelpfulVote::where('vote',true)->count())
                    ->where('articleSlug', $article->slug)
                )
            );
    });
    
    it('returns a 404 for unpublished articles', function () {
        $article = Article::factory()->create();
    
        get(route('article.view', $article->slug))
            ->assertNotFound();
    });
});

describe('for logged in users', function(){
    it('can display a draft article', function () {
        $article = Article::factory()
            ->state([
                'status' => 'draft'
            ])
            ->create();
            
        actingAs(User::factory()->create());

        get(route('article.view', $article->slug))
            ->assertOk();
    });

    it('can display a hidden article', function () {
        $article = Article::factory()
            ->state([
                'status' => 'hidden'
            ])
            ->create();
            
        actingAs(User::factory()->create());

        get(route('article.view', $article->slug))
            ->assertOk();
    });
    
    it('can display an archived article', function () {
        $article = Article::factory()
            ->state([
                'status' => 'archived'
            ])
            ->create();
            
        actingAs(User::factory()->create());

        get(route('article.view', $article->slug))
            ->assertOk();
    });
});

test('the side navigation displays only published articles', function () {
    $article = Article::factory()->published()->hasCategories(1)->create();
    Article::factory()->hasCategories(1)->create();

    get(route('article.view', $article->slug))
            ->assertOk()
            ->assertInertia(fn(AssertableInertia $page) => $page
                ->has('navigation', 1, fn(AssertableInertia $page) => $page
                ->has('name')
                ->has('articles', 1)
            )
        );
});
