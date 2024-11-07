<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function __invoke(Article $article)
    {
        $response = Gate::inspect('view', $article);

        if(!$response->allowed())
            abort(404);

        $navigation = $this->getNavigationItems();

        $previous = Article::where('order', '<', $article->order)
                    ->orderByDesc('order')
                    ->first();

        $next = Article::where('order', '>', $article->order)
                    ->first();

        $helpfulMetrics = $this->getHelpfulMetrics($article);

        return Inertia::render('Article', [
            'article' => $article->only([
                'name',
                'content',
                'updated_at',
                'slug',
                'categories',
            ]),
            'navigation' => $navigation,
            'previous' => $previous !== null ? $previous->only(['name','slug','order']) : null,
            'next' => $next !== null ? $next->only(['name','slug','order']) : null,
            'helpfulMetrics' => $helpfulMetrics,
        ]);
    }

    private function getNavigationItems(): Collection
    {
        return Category::query()
            ->whereRelation('articles', 'status', 'published')
            ->with(['articles' => function ($query) {
                $query->where('status', 'published');
            }])
            ->get()
            ->setVisible(['name', 'slug', 'articles'])
            ->each(fn($category) => $category->articles->setVisible(['name', 'slug']));
    }

    private function getHelpfulMetrics(Article $article): array
    {
        return [
            'totalVotes' => $article->votes->count(),
            'foundHelpful' => $article->votes->where('vote',true)->count(),
            'articleSlug' => $article->slug,
        ];
    }
}
