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
 
        User::create(['name' => 'Brayan Eduardo Rojas Freyre',
        'email' => 'rfreyrebrayaned@gmail.com',
        'password' => ('123456789'),'email_verified_at' => now(),'user_type_id' => 1,'employee_id' => 1]);

        // User::factory(20)->create();
    }
}
