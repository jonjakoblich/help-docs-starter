<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
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

        $categories = Category::factory()
            ->count(3)
            ->featured()
            ->create();

        $startingOrder = 10;

        Article::factory()
            ->count(5)
            ->sequence(
                fn(Sequence $sequence) => ['order' => $sequence->index * 10]
            )
            ->hasAttached($categories->random(rand(1,2)))
            ->hasVotes(rand(5,20))
            ->published()
            ->create();

        Article::factory()
            ->count(5)
            ->sequence(
                fn(Sequence $sequence) => ['order' => $sequence->index * 11]
            )
            ->hasAttached($categories->random(rand(1,2)))
            ->hasVotes(rand(5,20))
            ->published()
            ->featured()
            ->create();
    }
}
