<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\SubCategoryController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('empleados',EmployeeController::class)->names('employee');
Route::resource('productos',ProductController::class)->names('products');
Route::resource('categorias',CategoryController::class)->names('categories');
Route::resource('subcategorias',SubCategoryController::class)->names('sub_categories');

// Ruta para mostrar productos por categoría
Route::get('products/category/{id}', [ProductController::class, 'showbycategory'])->name('products.category');

// Ruta para mostrar productos por subcategoría
Route::get('products/subcategory/{id}', [ProductController::class, 'showbysubcategory'])->name('products.subcategory');

// Route::group(['middleware' => 'auth:api'], function () {
//     // Rutas protegidas que requieren autenticación
//     Route::resource('empleados', EmployeeController::class)->names('employee');
//     Route::resource('productos', ProductController::class)->names('products');
//     Route::resource('categorias', CategoryController::class)->names('categories');
//     Route::resource('subcategorias', SubCategoryController::class)->names('sub_categories');
// });