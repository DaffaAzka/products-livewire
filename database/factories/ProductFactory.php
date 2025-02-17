<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 *
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => 'default.jpg',
        'title' => $this->faker->word,
        'slug' => Str::slug($this->faker->word),
        'description' => $this->faker->sentence,
        'price' => $this->faker->numberBetween(1000, 100000),
        'stock' => $this->faker->numberBetween(0, 100),
        'category_id' => Category::factory()->create()->id,
        ];
    }
}
