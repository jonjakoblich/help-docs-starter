<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Options>
 */
class OptionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'theme_color' => '#ff0000',
            'logo_path' => fake()->filePath(),
            'product_name' => fake()->company(),
            'product_url' => fake()->url(),
        ];
    }
}
