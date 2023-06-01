<?php

namespace Database\Seeders;

use App\Models\User_type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class User_typeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User_type::create(['name' => 'Admin']);
        User_type::create(['name' => 'Cajero']);
        User_type::create(['name' => 'Almacen']);
        User_type::create(['name' => 'Cliente']);
    }
}
