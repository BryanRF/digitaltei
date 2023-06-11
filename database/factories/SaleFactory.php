<?php

namespace Database\Factories;

use App\Models\Customer;
use Faker\Generator as Faker;
use App\Models\Sale;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
        protected $model = Sale::class;
    public function definition()
    {
        $customerIds = Customer::pluck('id')->all();
        $paymentMethodIds = PaymentMethod::pluck('id')->all();
        return [
            'customer_id' => $this->faker->randomElement($customerIds),
            'date' => $this->faker->date(),
            'total_amount' => $this->faker->randomFloat(2, 10, 1000),
            'payment_method_id' => $this->faker->randomElement($paymentMethodIds),
            'status' => $this->faker->randomElement(['Pendiente','Enviado', 'Entregado','Cancelado','Devuelto']),
            'payment_status' => $this->faker->randomElement(['Pagado', 'Cancelado', 'Pendiente','Devuelto']),
        ];
    }
}
