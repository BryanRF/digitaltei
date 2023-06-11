<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $marcas = array('LG', 'Samsung', 'HP', 'Dell', 'Acer', 'Asus', 'AOC', 'ViewSonic', 'Philips', 'Lenovo','Apple', 'Logitech', 'Microsoft', 'Genius');
        foreach ($marcas as $marca) {
            Brand::factory()->create([
                'name' => $marca,
                'image' => 'images/'.$marca.'.png',
            ]);
        }
    }
}
