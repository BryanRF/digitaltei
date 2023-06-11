<?php

namespace Database\Seeders;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{

    public function run()
    {
        $categorias = array('Computadoras','Monitores','Accesorios','Camaras','Impresoras','Componentes');
        foreach ($categorias as $categoria) {
            Category::factory()->create([
                'name' => $categoria,
                'image' => 'images/'.$categoria.'.png',
            ]);
        }

    }
}
