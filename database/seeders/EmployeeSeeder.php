<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
  
        Employee::create(['name' => 'Brayan Eduardo',
        'lastname' => 'Rojas Freyre',
        'document' => '74473887',
        'slug' => Str::slug("Rojas Freyre 74473887",'-'),
        'email' => 'rfreyrebrayaned@gmail.com',
        'address' => 'Peru, Lambayeque',
        'phone' => '+51998511769',
        'avatar' => 'images/0twcwAJ0gXptdkaUWyGq.png',
        'birthday_date' => '1999-12-26',
        'gender' => 'Masculino',
        'job_id' => 1,
        'isUser' => 1
    
    ]);

        Employee::factory(100)->create();
    }
}