<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\States\Published;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomePageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $articles = Article::select(['name','slug','order'])
                    ->whereState('status',Published::class)
                    ->where('featured',true)
                    ->withoutEagerLoads()
                    ->get()
                    ->makeHidden('pivot');

        $categories = Category::select(['name','slug'])
                        ->where('featured',true)
                        ->get();

        return Inertia::render('Home',[
            'featuredArticles' => $articles,
            'featuredCategories' => $categories,
        ]);
    }
}
