<?php

namespace Database\Seeders;

use App\Models\CustomerType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomerType::create(['name' => 'Natural','description' => 'Personal']);
        CustomerType::create(['name' => 'Juridico','description' => 'Empresa']);
    }
}
