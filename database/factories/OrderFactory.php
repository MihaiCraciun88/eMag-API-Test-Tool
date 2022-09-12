<?php
namespace Database\Factories;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $payment_mode_id = rand(0, 1) === 1 ? 1 : 3;
        $payment_mode = $payment_mode_id === 1 ? 'RAMBURS' : 'CARD online';
        return [
            'type' => 3,
            'vendor_name' => 'Test Vendor',
            'mkt_id' => 0,
            'parent_id' => 0,
            'date' => now(),
            'finalization_date' => now(),
            'maximum_date_for_shipment' => now(),
            'payment_mode' => $payment_mode,
            'payment_mode_id' => $payment_mode_id,
            'detailed_payment_method' => $payment_mode,
            'delivery_mode' => rand(0, 1) === 1 ? 'pickup' : 'courier',
            'observation' => '',
            'status' => 4,
            'payment_status' => 0,
            'customer_id' => 0,
            'shipping_tax' => '14.99',
            'has_editable_products' => 1,
            'refunded_amount' => 0,
            'is_complete' => 1,
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

    public function customer(Customer $customer)
    {
        return $this->state(function (array $attributes) use ($customer) {
            return [
                'customer_id' => $customer->id,
            ];
        });
    }
}
