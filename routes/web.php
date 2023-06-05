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
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Auth\PasswordResetLinkController;
Route::get('/', LoginController::class)->name('auth.login');
Route::get('cerrar-session', [LogoutController::class, 'logout'])->name('logout');

Route::get('datatable/product', [DataTablesController::class, 'product'])->name('datatable.product');
Route::get('datatable/category', [DataTablesController::class, 'category'])->name('datatable.category');
Route::get('datatable/subcategory', [DataTablesController::class, 'subcategory'])->name('datatable.subcategory');
// Route::delete('/registros/{id}', 'RegistroController@destroy')->name('registros.destroy');
// Route::view("ejemplo","ejemplo")->name('ejemplo');




// Route::match(['put', 'patch'], 'empleados/{id}', [EmployeeController::class, 'restored'])->name('employee.restored');
//! Api datatable
Route::get('datatable/employee', [DataTablesController::class, 'employee'])->name('datatable.employee');
Route::get('datatable/employee/trashed', [DataTablesController::class, 'employeeTrashed'])->name('datatable.employee.trashed');
//!-----------------------------------------------------------------------------------------------------------------------------------

//! Api datatable
Route::get('datatable/empleados/contratos/{id}', [DataTablesController::class, 'contractById'])->name('datatable.contract.employee');
Route::get('datatable/contratos', [DataTablesController::class, 'contract'])->name('datatable.contract');
Route::get('datatable/contratos/trashed', [DataTablesController::class, 'contractTrashed'])->name('datatable.contract.trashed');



Route::get('empleados/dni/{document}', [EmployeeController::class, 'showbydni'])->name('employee.dni');
//*-----------------------------------------------------------------------------------------------------------------------------------
//! Registrar
Route::get('registo/empleados', [RegisterController::class, 'showEmployee'])->name('auth.register.show');
Route::post('registrar/empleados', [RegisterController::class, 'registerEmployee'])->name('auth.register.store');
// Route::get('registo/clientes', [RegisterController::class, 'showCustomer'])->name('auth.register.show.customer');
// Route::post('registrar/clientes', [RegisterController::class, 'registerCustomer'])->name('auth.register.store.customer');
//! Login
Route::post('logearse/empleados', [LoginController::class, 'loginEmployee'])->name('auth.login.employee');
Route::post('logearse/clientes', [LoginController::class, 'loginCumstomer'])->name('auth.login.customer');
//! Logout



Route::middleware(['auth.check','verified'])->group(function () {
    //! Paginas
    Route::get('inicio', HomeController::class)->name('home');
    //! Empleados
    Route::resource('empleados',EmployeeController::class)->parameters(['empleados'=>'employee'])->names('employee');
    Route::delete('empleados/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroyed');
    Route::put('empleados/restaurar/{id}', [EmployeeController::class, 'restored'])->name('employee.restored');
    Route::resource('productos',ProductController::class)->parameters(['productos'=>'product'])->names('product');
    Route::get('papelera/empleados', [RecycleController::class, 'employees'])->name('recycle.employee.index');
    //! Contratos
    Route::resource('contratos',ContractController::class)->parameters(['contratos'=>'contract'])->names('contract');
    Route::get('empleados/contratos/{id}', [ContractController::class, 'show'])->name('employee.contract.show');
    Route::delete('contratos/{id}', [ContractController::class, 'destroy'])->name('contract.destroyed');
    Route::get('papelera/contratos', [RecycleController::class, 'contract'])->name('recycle.contract.index');
    Route::put('contratos/restaurar/{id}', [ContractController::class, 'restored'])->name('contract.restored');
});
//* VERIFICACION DE CORREO ELECTRONICO
//Solo es la ruta que recibe el correo hacia la pagina
Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');
//Reenviar confirmacion
Route::get('verify-email', EmailVerificationPromptController::class)
->name('verification.notice');
//Confirmacion enviada correctamente
Route::get('notification-comfirm', EmailNotificationController::class)
->name('notification.comfirm');

Route::get('check-password/{password}', [UserController::class, 'checkPassword'])->name('user.checkPassword');

// require __DIR__.'/auth.php';

//*RECUPERACION DE CONTRASEÑA
Route::get('password-reset', PasswordResetLinkController::class)
->name('auth.forgot-password');

Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.store');