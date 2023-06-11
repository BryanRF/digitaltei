<?php
//!-----------------------------------------------------------------------------------------------------------------------------------
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
//!-----------------------------------------------------------------------------------------------------------------------------------
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\RecycleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\ImageController;
//!-----------------------------------------------------------------------------------------------------------------------------------
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
//!-----------------------------------------------------------------------------------------------------------------------------------
use App\Http\Controllers\DataTables\ProductDataTables;
use App\Http\Controllers\DataTables\CategoryDataTables;
use App\Http\Controllers\DataTables\SubCategoryDataTables;
use App\Http\Controllers\DataTables\ContractDataTables;
use App\Http\Controllers\DataTables\EmployeeDataTables;
use App\Http\Controllers\DataTables\SaleDataTables;
//!-----------------------------------------------------------------------------------------------------------------------------------
//*-----------------------------------------------------------------------------------------------------------------------------------
//TODO: Paginas autorizadas por login
Route::middleware(['auth.check','verified','auth:sanctum'])->group(function () {
    //! Paginas
    Route::get('inicio', HomeController::class)->name('home');
    //! Empleados
    Route::resource('empleados',EmployeeController::class)->parameters(['empleados'=>'employee'])->names('employee');
    Route::delete('empleados/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroyed');
    Route::put('empleados/restaurar/{id}', [EmployeeController::class, 'restored'])->name('employee.restored');
    Route::get('papelera/empleados', [RecycleController::class, 'employees'])->name('recycle.employee.index');
    Route::get('empleados/dni/{document}', [EmployeeController::class, 'showbydni'])->name('employee.dni');
    //! Contratos
    Route::resource('contratos',ContractController::class)->parameters(['contratos'=>'contract'])->names('contract');
    Route::get('empleados/contratos/{id}', [ContractController::class, 'show'])->name('employee.contract.show');
    Route::delete('contratos/{id}', [ContractController::class, 'destroy'])->name('contract.destroyed');
    Route::get('papelera/contratos', [RecycleController::class, 'contract'])->name('recycle.contract.index');
    Route::put('contratos/restaurar/{id}', [ContractController::class, 'restored'])->name('contract.restored');
    //! Productos
    Route::resource('productos',ProductController::class)->parameters(['productos'=>'product'])->names('product');
    Route::delete('productos/{id}', [ProductController::class, 'destroy'])->name('product.destroyed');
    //! Imagenes
    Route::get('productos/images/{id}', [ImageController::class, 'create'])->name('image.create');
    Route::post('productos/images/{id}', [ImageController::class, 'store'])->name('image.store');
    Route::delete('images/{id}', [ImageController::class, 'destroy'])->name('image.destroyed');
    //! Productos
    Route::resource('pedidos',SaleController::class)->parameters(['pedidos'=>'sale'])->names('sale');
    // Route::delete('productos/{id}', [ProductController::class, 'destroy'])->name('product.destroyed');

    //*-----------------------------------------------------------------------------------------------------------------------------------
    //!-----------------------------------------------------------------------------------------------------------------------------------
    //TODO: DATA TABLES-------------------------------------------------------------------------------------------------------------------

    //TODO: Priv Productos
    Route::get('datatable/product', [ProductDataTables::class, 'product'])->name('datatable.product');
    //TODO: Priv Categoria
    Route::get('datatable/category', [CategoryDataTables::class, 'category'])->name('datatable.category');
    Route::get('datatable/category/subcategory/{id}', [CategoryDataTables::class, 'category'])->name('datatable.category.subcategory');
    //TODO: Priv Subcategoria
    Route::get('datatable/subcategory', [SubCategoryDataTables::class, 'subcategory'])->name('datatable.subcategory');
    Route::get('datatable/subcategory/category/{id}', [SubCategoryDataTables::class, 'subcategorybycategory'])->name('datatable.subcategory.category');
    //TODO: Priv Empleados
    Route::get('datatable/employee', [EmployeeDataTables::class, 'employee'])->name('datatable.employee');
    Route::get('datatable/employee/trashed', [EmployeeDataTables::class, 'employeeTrashed'])->name('datatable.employee.trashed');
    //TODO: Priv Contratos
    Route::get('datatable/empleados/contratos/{id}', [ContractDataTables::class, 'contractById'])->name('datatable.contract.employee');
    Route::get('datatable/contratos', [ContractDataTables::class, 'contract'])->name('datatable.contract');
    Route::get('datatable/contratos/trashed', [ContractDataTables::class, 'contractTrashed'])->name('datatable.contract.trashed');
    //TODO: Priv Pedidos
    Route::get('datatable/pedidos', [SaleDataTables::class, 'sale'])->name('datatable.sale');
});

//*-----------------------------------------------------------------------------------------------------------------------------------
//!-----------------------------------------------------------------------------------------------------------------------------------
//TODO: ACCESO AL SISTEMA ADMINISTRATIVO
//! Login vista
Route::get('/', LoginController::class)->name('auth.login');
//! Registrar
Route::get('registo/empleados', [RegisterController::class, 'showEmployee'])->name('auth.register.show');
Route::post('registrar/empleados', [RegisterController::class, 'registerEmployee'])->name('auth.register.store');
//! Login
Route::post('logearse/empleados', [LoginController::class, 'loginEmployee'])->name('auth.login.employee');
Route::post('logearse/clientes', [LoginController::class, 'loginCumstomer'])->name('auth.login.customer');
//! Logout
Route::get('cerrar-session', [LogoutController::class, 'logout'])->name('logout');
//*-----------------------------------------------------------------------------------------------------------------------------------
//!-----------------------------------------------------------------------------------------------------------------------------------
//TODO: ACCESO AL SISTEMA ADMINISTRATIVO
//*Solo es la ruta que recibe el correo hacia la pagina
Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');
//*Reenviar confirmacion
Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');
//*Confirmacion enviada correctamente
Route::get('notification-comfirm', EmailNotificationController::class)->name('notification.comfirm');
//*Confirmacion enviada correctamente
Route::get('check-password/{password}', [UserController::class, 'checkPassword'])->name('user.checkPassword');
//*-----------------------------------------------------------------------------------------------------------------------------------
//!-----------------------------------------------------------------------------------------------------------------------------------
//TODO: RECUPERACION DE CONTRASEÑA FALTA
Route::get('password-reset', PasswordResetLinkController::class)->name('auth.forgot-password');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');
Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('reset-password', [NewPasswordController::class, 'store'])->middleware('guest')->name('password.store');

Route::get('/generate/{code}', [BarcodeController::class, 'generate'])->name('barcode.generate');

Route::get('/generate-qr/{code}', [BarcodeController::class, 'generateQrCode'])->name('barcode.generate-qr');

