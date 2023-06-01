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
        $palabras = ['computadoras', 'mouse', 'monitor', 'impresora', 'case', 'teclado', 'auriculares', 'altavoces', 'impresora', 'tablet', 'disco duro', 'proyector', 'cámara', 'smartphone', 'router', 'tarjeta gráfica', 'memoria RAM', 'impresora', 'escáner', 'laptop', 'servidor', 'monitor', 'impresora', 'case', 'ratón', 'fuente de poder', 'monitor', 'impresora', 'case', 'dispositivo de almacenamiento'];
        $producto = $palabras[array_rand($palabras)];
        
        return [
            'name' => $producto . ' ' . $this->faker->unique()->word,
            'description' => $this->faker->realText(20),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'presentation' => $this->faker->realText(20),
            'status' => $this->faker->boolean,
            'image' => 'images/default_product.png',
            'slug' => Str::slug($this->faker->unique()->name,'-'),
            'brand_id' => Brand::inRandomOrder()->first()->id,
            'subcategory_id' => Subcategory::inRandomOrder()->first()->id,
            'type_id' => Type::inRandomOrder()->first()->id
        ];
    }
}
