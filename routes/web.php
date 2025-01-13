<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\GuestController;
Route::get('/', [GuestController::class, 'home']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.dashboard');
    Route::get('/admin/categories', [CategoryController::class, 'index']);
    Route::post('/admin/category/store', [CategoryController::class, 'store']);
    Route::post('/admin/category/update', [CategoryController::class, 'update']);
    Route::get('/admin/category/{id}/delete', [CategoryController::class, 'destroy']);
});
Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
Route::post('/admin/products/store', [ProductController::class, 'store']);
Route::post('/admin/products/update', [ProductController::class, 'update']);
Route::get('/admin/products/{id}/delete', [ProductController::class, 'destroy']);

Route::get('/', [GuestController::class, 'home']);
Route::get('/product/details/{id}', [GuestController::class, 'productDetails']);
Route::get('/products/{category}/list', [GuestController::class, 'shop']);
Route::post('/products/search', [GuestController::class, 'search']);