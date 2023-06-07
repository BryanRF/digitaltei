<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SubCategoryController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\UserTypeController;
use App\Http\Controllers\API\CustomerTypeController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    
});

Route::resource('empleados',EmployeeController::class)->names('employee');
Route::resource('productos',ProductController::class)->names('products');
Route::resource('categorias',CategoryController::class)->names('categories');
Route::resource('subcategorias',SubCategoryController::class)->names('sub_categories');
Route::resource('tipo_usuarios',UserTypeController::class)->names('user_types');
Route::resource('tipo_clientes',CustomerTypeController::class)->names('customer_types');

// Ruta para login
Route::post('login', [LoginController::class, 'login'])->name('login.access');
Route::post('registrer', [RegisterController::class, 'register'])->name('register.access');

// Ruta para mostrar productos por categoría
Route::get('products/category/{id}', [ProductController::class, 'showbycategory'])->name('products.category');

// Ruta para mostrar productos por subcategoría
Route::get('products/subcategory/{id}', [ProductController::class, 'showbysubcategory'])->name('products.subcategory');

