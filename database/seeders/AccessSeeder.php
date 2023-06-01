<?php

namespace Database\Seeders;

use App\Models\Access;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            // //? accessos y permisos de empleado id=1
            $accesses = new Access;
            $accesses->users_id = 1;
            $accesses->access_details_id = 1;
            $accesses->save();
    }

}
