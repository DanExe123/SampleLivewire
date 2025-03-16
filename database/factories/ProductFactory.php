<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word . ' ' . $this->faker->randomElement(['Toy', 'Food', 'Accessory', 'Gadget']),
            'category' => $this->faker->randomElement(['Pet Supplies', 'Pet Accessories', 'Pet Housing']),
            'price' => $this->faker->randomFloat(2, 50, 5000), // Price between 50 and 5000
            'stock' => $this->faker->numberBetween(1, 200),
            'description' => $this->faker->sentence(),
            'image' => json_encode(['product-images/' . basename($this->faker->image(public_path('product-images'), 640, 480, null, false))]),

        ];
    }
}
