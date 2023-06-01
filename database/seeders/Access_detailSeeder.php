<?php

namespace Database\Seeders;

use App\Models\Access_detail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Access_detailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Access_detail::create([
            'name' => 'Todos los permisos',
            'reference' => 'all',
            'type' => 'administrative',
        ]);
        
        Access_detail::create([
            'name' => 'Agregar Registros',
            'reference' => 'creates',
            'type' => 'administrative',
        ]);
        
        Access_detail::create([
            'name' => 'Editar Registros',
            'reference' => 'updates',
            'type' => 'administrative',
        ]);
        
        Access_detail::create([
            'name' => 'Eliminar Registros',
            'reference' => 'deletes',
            'type' => 'administrative',
        ]);
        
        Access_detail::create([
            'name' => 'Gestion de Empleados',
            'reference' => 'employee_management',
            'type' => 'administrative',
        ]);
        
        Access_detail::create([
            'name' => 'Venta Productos',
            'reference' => 'sale_products',
            'type' => 'sale',
        ]);
        
        Access_detail::create([
            'name' => 'Gestion de Productos',
            'reference' => 'product_management',
            'type' => 'administrative',
        ]);
        
        Access_detail::create([
            'name' => 'Gestion de Usuarios',
            'reference' => 'user_management',
            'type' => 'administrative',
        ]);
        
    }
}
