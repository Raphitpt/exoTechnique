<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'type_id' => $this->faker->numberBetween(1, 10),
            'age' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->text(),
            'state' => $this->faker->randomElement(['en vente', 'vendu']),
            'pictures' => $this->faker->imageUrl(),
        ];
    }
}
