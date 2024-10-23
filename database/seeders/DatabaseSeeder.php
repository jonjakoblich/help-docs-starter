<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Category::factory()
            ->count(3)
            ->featured()
            ->create();

        Article::factory()
            ->count(5)
            ->published()
            ->create();

        Article::factory()
            ->count(5)
            ->published()
            ->featured()
            ->create();
    }
}
