<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sale;
use Faker\Generator as Faker;
use App\Models\SalesDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesDetail>
 */
class SalesDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = SalesDetail::class;
    public function definition()
    {
        $saleIds = Sale::pluck('id')->all();
        $productIds = Product::pluck('id')->all();
        $productId = $this->faker->randomElement($productIds);
        $productPrice = Product::find($productId)->price;
        $quantity = $this->faker->numberBetween(1, 10);
        $discount = $this->faker->randomFloat(2, 0, 100);
        $total = ($productPrice * $quantity) - $discount;
        $sale = Sale::find($saleIds);
   
        return [
            'sale_id' => $this->faker->randomElement($saleIds),
            'product_id' => $productId,
            'quantity' => $quantity,
            'unit_price' => $productPrice,
            'discount' => $discount,
            'total' => $total,
        ];
    }
}
