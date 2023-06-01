<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $palabras = [
            'ordenadores',
            'ratones',
            'monitores',
            'impresoras',
            'cajas',
            'teclados',
            'auriculares',
            'altavoces',
            'tabletas',
            'discos duros',
            'proyectores',
            'cámaras',
            'teléfonos inteligentes',
            'routers',
            'tarjetas gráficas',
            'memorias RAM',
            'escáneres',
            'portátiles',
            'servidores',
            'ratones',
            'fuentes de poder',
            'dispositivos de almacenamiento',
            'reproductores de música',
            'televisores',
            'cargadores',
            'accesorios de telefonía',
            'cables',
            'adaptadores',
            'videojuegos',
            'consolas',
            'cámaras de seguridad',
            'smartwatches',
            'impresoras 3D',
            'robot aspirador',
            'sistemas de sonido',
            'procesadores',
            'tarjetas de sonido',
            'microondas',
            'cámaras de acción',
            'drones',
            'lentes de realidad virtual',
            'reproductores de Blu-ray'
        ];
        
    static $index = 0;
    $producto = $palabras[$index % count($palabras)];
    $index++;
        return [
            'name' => $producto,
            'category_id' => Category::inRandomOrder()->first()->id

       ];
    }
}
