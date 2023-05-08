<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DataTablesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', HomeController::class)->name('home');
Route::resource('empleados',EmployeeController::class)->
parameters(['empleados'=>'employee'])->names('employee');

Route::resource('productos',ProductController::class)->
parameters(['productos'=>'product'])->names('product');

Route::get('datatable/employee', [DataTablesController::class, 'employee'])->name('datatable.employee');
Route::get('datatable/product', [DataTablesController::class, 'product'])->name('datatable.product');
// Route::delete('/registros/{id}', 'RegistroController@destroy')->name('registros.destroy');
// Route::view("ejemplo","ejemplo")->name('ejemplo');