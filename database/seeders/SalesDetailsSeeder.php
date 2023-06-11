<?php

namespace Database\Seeders;

use App\Models\SalesDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SalesDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numero_aleatorio = rand(300, 500);
        SalesDetail::factory($numero_aleatorio)->create();
    }
}
