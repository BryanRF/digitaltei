<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::create(['name' => 'Administrador']);
        Job::create(['name' => 'Cajero']);
        Job::create(['name' => 'Delivery']);
        Job::create(['name' => 'Contador']);
        Job::create(['name' => 'Tecnico']);
        Job::create(['name' => 'Desarrollador']);
    }
}
