<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RecycleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DataTablesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', HomeController::class)->name('home');



Route::resource('productos',ProductController::class)->parameters(['productos'=>'product'])->names('product');
Route::get('datatable/product', [DataTablesController::class, 'product'])->name('datatable.product');
Route::get('datatable/category', [DataTablesController::class, 'category'])->name('datatable.category');
Route::get('datatable/subcategory', [DataTablesController::class, 'subcategory'])->name('datatable.subcategory');
// Route::delete('/registros/{id}', 'RegistroController@destroy')->name('registros.destroy');
// Route::view("ejemplo","ejemplo")->name('ejemplo');

//! Empleados
Route::resource('empleados',EmployeeController::class)->parameters(['empleados'=>'employee'])->names('employee');
Route::delete('empleados/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroyed');
Route::get('papelera/empleados', [RecycleController::class, 'employees'])->name('recycle.employee.index');
Route::put('empleados/restaurar/{id}', [EmployeeController::class, 'restored'])->name('employee.restored');
// Route::match(['put', 'patch'], 'empleados/{id}', [EmployeeController::class, 'restored'])->name('employee.restored');
//! Api datatable
Route::get('datatable/employee', [DataTablesController::class, 'employee'])->name('datatable.employee');
Route::get('datatable/employee/trashed', [DataTablesController::class, 'employeeTrashed'])->name('datatable.employee.trashed');