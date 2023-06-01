<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\RecycleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DataTablesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', LoginController::class)->name('auth.login');

Route::get('inicio', HomeController::class)->name('home');


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
//!-----------------------------------------------------------------------------------------------------------------------------------
//! Contratos
Route::resource('contratos',ContractController::class)->parameters(['contratos'=>'contract'])->names('contract');
Route::get('empleados/contratos/{id}', [ContractController::class, 'show'])->name('employee.contract.show');
//! Api datatable
Route::get('datatable/empleados/contratos/{id}', [DataTablesController::class, 'contractById'])->name('datatable.contract.employee');
Route::get('datatable/contratos', [DataTablesController::class, 'contract'])->name('datatable.contract');

Route::get('empleados/dni/{document}', [EmployeeController::class, 'showbydni'])->name('employee.dni');
//*-----------------------------------------------------------------------------------------------------------------------------------
//! Registrar
Route::get('registo/empleados', [RegisterController::class, 'showEmployee'])->name('auth.register');
Route::post('registrar/empleados', [RegisterController::class, 'registerEmployee'])->name('auth.register');
Route::get('registo/clientes', [RegisterController::class, 'showCustomer'])->name('auth.register');
Route::post('registrar/clientes', [RegisterController::class, 'registerCustomer'])->name('auth.register');
//! Login
Route::post('logearse/empleados', [LoginController::class, 'loginEmployee'])->name('auth.login.employee');
Route::post('logearse/clientes', [LoginController::class, 'loginCumstomer'])->name('auth.login.customer');
Route::get('cerrar-session', [LogoutController::class, 'logout'])->name('logout');


