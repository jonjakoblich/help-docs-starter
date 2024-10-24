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
            ->first();

        $next = Article::where('order', '>', $article->order)
            ->first();

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
        ]);
    }

    private function getNavigationItems(): Collection
    {
        return Article::whereState('status', Published::class)->get();
    }
}
