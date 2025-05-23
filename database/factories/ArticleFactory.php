<?php

namespace Database\Factories;

use App\Models\User;
use App\States\Published;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(rand(2,5),true);

        return [
            'name' => Str::title($name),
            'content' => fake()->realText(500),
            'author_id' => User::factory(),
            'slug' => Str::slug($name),
        ];
    }

    public function published(): Factory
    {
        return $this->state(fn(array $attributes) => ['status' => Published::$name]);
    }

    public function featured(): self
    {
        return $this->state(fn(array $attributes) => [
            'featured' => true
        ]);
    }
}
