<?php

namespace Database\Seeders;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SubCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategorias = [
            'Computadoras' => [
                'Laptops',
                'PC de escritorio',
                'Tablets'
            ],
            'Monitores' => [
                'Monitores LED',
                'Monitores LCD',
                'Monitores Gaming'
            ],
            'Accesorios' => [
                'Teclados',
                'Mouse',
                'Altavoces',
                'Fundas'
            ],
            'Camaras' => [
                'Cámaras DSLR',
                'Cámaras sin espejo',
                'Cámaras de acción',
                'Cámaras de seguridad'
            ],
            'Impresoras' => [
                'Impresoras láser',
                'Impresoras de inyección de tinta',
                'Impresoras multifuncionales'
            ],
            'Componentes' => [
                'Procesadores',
                'Tarjetas gráficas',
                'Memorias RAM',
                'Discos duros',
                'Placas base'
            ]
        ];

        foreach ($subcategorias as $categoria => $subcategoriaArray) {
            foreach ($subcategoriaArray as $subcategoria) {
                SubCategory::factory()->create([
                    'name' => $subcategoria,
                    'category_id' => \App\Models\Category::where('name', $categoria)->first()->id
                ]);
            }
        }
    }
}

