<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('empleados',EmployeeController::class)->parameters(['empleados'=>'employee'])->names('employee');
Route::resource('productos',ProductController::class)->parameters(['productos'=>'products'])->names('products');
Route::resource('categorias',CategoryController::class)->parameters(['categorias'=>'categories'])->names('categories');
Route::resource('subcategorias',SubCategoryController::class)->parameters(['subcategorias'=>'sub_categories'])->names('sub_categories');