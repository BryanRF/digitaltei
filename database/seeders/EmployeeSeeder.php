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
        //!empleados pre registrados
        $employee = new Employee;
        $employee->name="Brayan Eduardo";
        $employee->lastname="Rojas Freyre";
        $employee->document="74473887";
        $txt= "Rojas Freyre 74473887";
        $employee->slug=Str::slug($txt,'-');
        $employee->email="rfreyrebrayaned@gmail.com";
        $employee->address="Peru, Lambayeque";
        $employee->phone="+51998511769";
        $employee->avatar = 'images/0twcwAJ0gXptdkaUWyGq.png';
        $employee->birthday_date ="1999-12-26";
        $employee->gender ="Masculino";
        $employee->jobs_id=1;
        $employee->isUser=1;
        $employee->save();
        Employee::factory(100)->create();
    }
}