<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->word();

        return [
            'name' => Str::title($name),
            'slug' => Str::slug($name),
        ];
    }

    public function featured(): self
    {
        return $this->state(fn(array $attributes) => [
            'featured' => true
        ]);
    }
}
