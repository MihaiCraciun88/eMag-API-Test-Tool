<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \App\Services\FakerEcommerceProvider($this->faker));
        $price = $this->faker->randomFloat(2, 5, 1000);
        return [
            'name' => $this->faker->productName,
            'part_number_key' => substr(strtoupper($this->faker->sku), 3, 9),
            'part_number' => $this->faker->isbn13,
            'currency' => 'RON',
            'sale_price' => $price,
            'original_price' => (rand(0, 10) > 5) ? number_format($price * 1.1, 2, '.', '') : $price,
            'vat' => '0.1900',
            'status' => '1',
            'mkt_id' => '0',
            'stock' => rand(3, 100),
            'created' => now(),
            'modified' => now(),
        ];
    }

    public function user(User $user)
    {
        return $this->state(function (array $attributes) use ($user) {
            return [
                'mkt_id' => $user->id,
            ];
        });
    }
}
