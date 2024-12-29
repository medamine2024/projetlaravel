<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
Route::get('/admin/categories', [CategoryController::class, 'index'])->Middleware('auth');
Route::post('/admin/category/store', [CategoryController::class, 'store']);
Route::post('/admin/category/update', [CategoryController::class, 'update']);
Route::get('/admin/category/{id}/delete', [CategoryController::class, 'destroy']);




/** Route of product */
Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
Route::post('/admin/products/store', [ProductController::class, 'store']);
Route::post('/admin/products/update', [ProductController::class, 'update']);
Route::get('/admin/products/{id}/delete', [ProductController::class, 'destroy']);