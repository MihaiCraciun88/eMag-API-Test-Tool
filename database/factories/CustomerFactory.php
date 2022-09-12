<?php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name();
        $phone = $this->faker->phoneNumber();
        return [
            'mkt_id' => 0,
            'name' => $name,
            'company' => $name,
            'gender' => '',
            'phone_1' => $this->faker->phoneNumber(),
            'phone_2' => '',
            'phone_3' => '',
            'registration_number' => '',
            'code' => '',
            'email' => '',
            'billing_name' => $name,
            'billing_phone' => $phone,
            'billing_country' => 'RO',
            'billing_suburb' => $this->faker->county(),
            'billing_city' => $this->faker->city(),
            'billing_street' => $this->faker->address(),
            'billing_postal_code' => '',
            'shipping_country' => '',
            'shipping_suburb' => '',
            'shipping_city' => '',
            'shipping_street' => '',
            'shipping_postal_code' => '',
            'shipping_contact' => $name,
            'shipping_phone' => $phone,
            'bank' => '',
            'iban' => '',
            'is_vat_payer' => 0,
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
