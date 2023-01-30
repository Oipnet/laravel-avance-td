<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use League\CommonMark\Normalizer\SlugNormalizer;
use function Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $title = fake()->sentence(4),
            'slug' => Str::slug($title, '-'),
            'description' => fake()->paragraphs(2, true),
            'price_in_cents' => fake()->numberBetween(500, 1000)
        ];
    }
}
