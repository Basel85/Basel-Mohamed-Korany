<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
Route::get('dashboard/products',[ProductController::class,'index'])->name('dashboard.products.index');
Route::get('dashboard/products/create',[ProductController::class,'create'])->name('dashboard.products.create');
Route::get('dashboard/products/edit/{id}',[ProductController::class,'edit'])->name('dashboard.products.edit');
Route::post('dashboard/products/store',[ProductController::class,'store'])->name('dashboard.products.store');
Route::put('dashboard/products/update/{id}',[ProductController::class,'update'])->name('dashboard.products.update');
Route::delete('dashboard/products/delete/{id}',[ProductController::class,'delete'])->name('dashboard.products.delete');

