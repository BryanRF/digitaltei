<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Type>
 */
class TypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $palabras = ['computadoras', 'mouse', 'monitor', 'impresora', 'case', 'teclado', 'auriculares', 'altavoces', 'tablet', 'disco duro', 'proyector', 'cámara', 'smartphone', 'router', 'tarjeta gráfica', 'memoria RAM', 'escáner', 'laptop', 'servidor', 'ratón', 'fuente de poder', 'dispositivo de almacenamiento'];
    
        static $index = 0;
        $producto = $palabras[$index % count($palabras)];
        $index++;
            return [
                'name' => $producto,

       ];
    }
}
