<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 
        User::create(['name' => 'Brayan Eduardo Rojas Freyre','email' => 'rfreyrebrayaned@gmail.com','password' => bcrypt('123456789'),'email_verified_at' => now(),'user_types_id' => 1,'employees_id' => 1]);

        User::factory(20)->create();
    }
}
