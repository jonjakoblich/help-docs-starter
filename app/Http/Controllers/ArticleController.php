<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\States\Published;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function __invoke(Article $article)
    {
        $navigation = $this->getNavigationItems();

        $previous = Article::where('order', '<', $article->order)
            ->first()
            ->only(['name','slug','order']);

        $next = Article::where('order', '>', $article->order)
            ->first()
            ->only(['name','slug','order']);

        return Inertia::render('Article', [
            'article' => $article->only([
                'name',
                'content',
                'updated_at',
                'slug',
                'categories',
            ]),
            'navigation' => $navigation,
            'previous' => $previous,
            'next' => $next,
        ]);
    }

    private function getNavigationItems(): Collection
    {
        return Article::whereState('status', Published::class)->get();
    }
}
