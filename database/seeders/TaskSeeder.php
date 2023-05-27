<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use Carbon\Carbon;
class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
   

        $new= new Task();
        $new->task_name = 'CRUD básico empleados';
        $new->description = 'Crear, listar, actualizar y eliminar empleados con Datatables, API, token, alertas y toasts.';
        $new->git_branch = 'feature/crud-empleados';
        $new->start_date = '2023-05-15';
        $new->deadline =  '2023-05-22';
        $new->status =  'Realizado';
        $new->save();

        $new1= new Task();
        $new1->task_name = 'Restaurar empleados';
        $new1->description = 'Implementar lista de papelera, función para restaurar y eliminar papelera después de 30 días.';
        $new1->git_branch = 'feature/restaurar-empleados';
        $new1->start_date = '2023-05-22';
        $new1->deadline =  '2023-05-27';
        $new1->status =  'Pendiente';
        $new1->save();

        $new2= new Task();
        $new2->task_name = 'Agregar Boton Contratos';
        $new2->description = 'Agregar un botón en la lista de empleados para redirigir a otro CRUD de Contratos';
        $new2->git_branch = 'feature/add-button-contratos';
        $new2->start_date = '2023-05-27';
        $new2->deadline =  '2023-05-30';
        $new2->status =  'Pendiente';
        $new2->save();
       
       
    }
}
