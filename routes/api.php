<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SubCategoryController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\LogoutController;
use App\Http\Controllers\API\UserTypeController;
use App\Http\Controllers\API\CustomerTypeController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    
});

Route::apiResource('empleados',EmployeeController::class);
Route::apiResource('productos',ProductController::class);
Route::apiResource('categorias',CategoryController::class);
Route::apiResource('subcategorias',SubCategoryController::class);
Route::apiResource('tipo_usuarios',UserTypeController::class);
Route::apiResource('tipo_clientes',CustomerTypeController::class);

// Ruta para login
Route::post('login', [LoginController::class, 'login']);
Route::post('registrer', [RegisterController::class, 'register']);
Route::post('logout', [LogoutController::class, 'logout']);

// Ruta para mostrar productos por categoría
Route::get('products/category/{id}', [ProductController::class, 'showbycategory']);

// Ruta para mostrar productos por subcategoría
Route::get('products/subcategory/{id}', [ProductController::class, 'showbysubcategory']);

Route::group(['middleware'=>['auth:sanctum']],function(){




});

use App\Http\Controllers\API\SaleController;
use App\Http\Controllers\API\SalesDetailController;

Route::apiResource('sales', SaleController::class);
// Route::apiResource('sales/{sale}/details', SalesDetailController::class);
Route::apiResource('details', SalesDetailController::class);
