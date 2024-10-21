<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ArticleController extends Controller
{
    public function __invoke(Article $article)
    {
        return Inertia::render('Article', $article->only([
            'name',
            'content',
            'updated_at',
            'slug',
            'categories',
        ]));
    }
}
