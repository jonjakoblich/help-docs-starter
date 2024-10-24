<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleSearchRequest;
use App\Models\Article;

class ArticleSearchController extends Controller
{
    public function __invoke(ArticleSearchRequest $request): string
    {
        return Article::search($request->validated('s'))->get();
    }
}