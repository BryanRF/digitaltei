<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $metodosPago = [
            'Efectivo',
            'Yape',
            'Plin',
            'Tarjeta de crédito',
        ];
        foreach ($metodosPago as $metodo) {
            PaymentMethod::create([
                'name' => $metodo,
            ]);
        }
    }
}
