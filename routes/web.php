<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index']);
Route::post('/products', [App\Http\Controllers\ProductController::class, 'store']);
Route::put('/products/{id}', [App\Http\Controllers\ProductController::class, 'update']);
Route::delete('/products/{id}', [App\Http\Controllers\ProductController::class, 'destroy']);

Route::get('/sales', [App\Http\Controllers\SaleController::class, 'index']);
Route::post('/sales', [App\Http\Controllers\SaleController::class, 'store']);

Route::get('/sales-history', [App\Http\Controllers\SaleController::class, 'history']);
Route::get('/sales/{id}/receipt', [App\Http\Controllers\SaleController::class, 'receipt']);


