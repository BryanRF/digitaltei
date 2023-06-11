<?php

namespace Database\Factories;

use App\Models\CustomerType;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Customer::class;

    public function definition()
    {
        $customerTypeIds = CustomerType::pluck('id')->all();

        return [
            'name' => $this->faker->name,
            'contact_name' => $this->faker->name,
            'ruc' => $this->faker->numerify('#############'),
            'ubication' => $this->faker->address,
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'customer_type_id' => $this->faker->randomElement($customerTypeIds),
        ];
    }
}
