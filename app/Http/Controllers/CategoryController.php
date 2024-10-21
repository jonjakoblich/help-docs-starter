<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function __invoke(Category $category)
    {
        return Inertia::render('Category', $category->only([
            'name',
            'slug',
            'articles',
        ]));
    }
}