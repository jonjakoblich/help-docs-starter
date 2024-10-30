<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\States\Published;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function __invoke(Category $category)
    {
        $pageData = [
            ...$category
                ->only([
                    'name',
                    'slug',
                ]),
            'articles' => $category->articles()
                            ->select(['name','slug','order'])
                            ->whereState('status',Published::class)
                            ->withoutEagerLoads()
                            ->get()
                            ->makeHidden('pivot'),
            'children' => [],
        ];

        if($category->children->count() > 0)
            $pageData['children'] = $category->children->each(fn (Category $child) => 
                    $child->setRelation('articles', Article::select('name','slug','order')
                        ->join('article_category', 'articles.id', '=', 'article_category.article_id')
                        ->where('article_category.category_id', $child->id)
                        ->withoutEagerLoads()
                        ->get()
                    )
                )
                ->select('name','articles');

        return Inertia::render('Category', $pageData);
    }
}