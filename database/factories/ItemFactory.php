<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->unique()->bothify('BRG-#####'),
            'name' => fake()->words(3, true),
            'category' => fake()->randomElement(['Elektronik', 'Alat Tulis', 'Perlengkapan']),
            'stock' => fake()->numberBetween(0, 200),
            'unit' => fake()->randomElement(['pcs', 'unit', 'box']),
            'price' => fake()->randomFloat(2, 1000, 1000000),
        ];
    }
}
