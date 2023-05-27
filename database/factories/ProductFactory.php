<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Type;

use Faker\Generator as Faker;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $maxRetries = 100000;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name,
            'description' => $this->faker->realText(20),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'presentation' => $this->faker->realText(20),
            'status' => $this->faker->boolean,
            'image' => 'images/default_product.png',
            'slug' => Str::slug($this->faker->unique()->name,'-'),
            //'utility' => $this->faker->words(3, true),
            'brand_id' => Brand::inRandomOrder()->first()->id,
            // 'category_id' => Category::inRandomOrder()->first()->id,
            'subcategory_id' => Subcategory::inRandomOrder()->first()->id,
            'type_id' => Type::inRandomOrder()->first()->id
        ];
    }
}
