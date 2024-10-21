<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\States\Published;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function __invoke(Category $category)
    {
        return Inertia::render('Category', [
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
                            ->makeHidden('pivot')
        ]);
    }
}