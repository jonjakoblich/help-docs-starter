<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleSearchRequest;
use App\Models\Article;

class ArticleSearchController extends Controller
{
    public function __invoke(ArticleSearchRequest $request): string
    {
        $results = Article::search($request->validated('s'))->get();

        /**
         * @todo Add the Scout metadata to each $results member object to return to the frontend.
         * This will provide the highlights and other Typesense metadata
         * Awaiting merge of PR #868 https://github.com/laravel/scout/pull/868
         */

        return $results;
    }
}