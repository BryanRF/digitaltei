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
        Task::create([
            'task_name' => 'CRUD básico empleados',
            'description' => 'Crear, listar, actualizar y eliminar empleados con Datatables, API, token, alertas y toasts.',
            'git_branch' => 'feature/crud-empleados',
            'start_date' => '2023-05-15',
            'deadline' => '2023-05-22',
            'status' => 'Realizado',
        ]);
        
        Task::create([
            'task_name' => 'Restaurar empleados',
            'description' => 'Implementar lista de papelera, función para restaurar y eliminar papelera después de 30 días.',
            'git_branch' => 'feature/restaurar-empleados',
            'start_date' => '2023-05-22',
            'deadline' => '2023-05-27',
            'status' => 'Pendiente',
        ]);
        
        Task::create([
            'task_name' => 'Agregar Boton Contratos',
            'description' => 'Agregar un botón en la lista de empleados para redirigir a otro CRUD de Contratos',
            'git_branch' => 'feature/add-button-contratos',
            'start_date' => '2023-05-27',
            'deadline' => '2023-05-30',
            'status' => 'Pendiente',
        ]);
        Task::create([
            'task_name' => 'CRUD Contratos',
            'description' => 'Crear, listar, actualizar y eliminar empleados con Datatables, API, token, alertas y toasts.',
            'git_branch' => 'feature/crud-contratos',
            'start_date' => '2023-06-1',
            'deadline' => '2023-06-8',
            'status' => 'Pendiente',
        ]);
        
    }
}
