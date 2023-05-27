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
        //!puestos de trabajo o roles
        
        $job= new Job();
        $job->name = 'Administrador';
        $job->save();

        $job_1= new Job();
        $job_1->name = 'Cajero';
        $job_1->save();

        $job_2= new Job();
        $job_2->name = 'Delivery';
        $job_2->save();

        $job_3= new Job();
        $job_3->name = 'Contador';
        $job_3->save();

        $job_4= new Job();
        $job_4->name = 'Tecnico';
        $job_4->save();

        $job_5= new Job();
        $job_5->name = 'Desarrollador';
        $job_5->save();
    }
}
