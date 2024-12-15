<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Models\Purchase;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/home' , [HomeController::class , 'index'])->name('home');

// Category Route
Route::get('categories/search', [CategoryController::class, 'search'])->name('categories.search');
Route::get('categories' , [CategoryController::class , 'index'])->name('categories.index');
Route::get('categories/create' , [CategoryController::class , 'create'])->name('categories.create');
Route::post('categories/create' , [CategoryController::class , 'store'])->name('categories.store');
Route::get('categories/{id}/edit' , [CategoryController::class , 'edit'])->name('categories.edit');
Route::put('categories/{id}/edit' , [CategoryController::class , 'update'])->name('categories.update');
Route::delete('categories/{id}' , [CategoryController::class , 'destroy'])->name('categories.destroy');

// Brand Route
Route::get('brands/search', [BrandController::class, 'search'])->name('brands.search');
Route::get('brands' , [BrandController::class , 'index'])->name('brands.index');
Route::get('brands/create' , [BrandController::class , 'create'])->name('brands.create');
Route::post('brands/create' , [BrandController::class , 'store'])->name('brands.store');
Route::get('brands/{id}/edit' , [BrandController::class , 'edit'])->name('brands.edit');
Route::put('brands/{id}/edit' , [BrandController::class , 'update'])->name('brands.update');
Route::delete('brands/{id}' , [BrandController::class , 'destroy'])->name('brands.destroy');

// Product Route
Route::get('products/search' , [ProductController::class , 'search'])->name('products.search');
Route::get('products' , [ProductController::class , 'index'])->name('products.index');
Route::get('products/create' , [ProductController::class , 'create'])->name('products.create');
Route::post('products/create' , [ProductController::class , 'store'])->name('products.store');
Route::get('products/{id}/edit',[ProductController::class,'edit'])->name('products.edit');
Route::put('products/{id}', [ProductController::class, 'update'])->name('products.update');

// Supplier Route
Route::get('suppliers/search' , [SupplierController::class , 'search'])->name('suppliers.search');
Route::get('suppliers' , [SupplierController::class , 'index'])->name('suppliers.index');
Route::get('suppliers/create' , [SupplierController::class , 'create'])->name('suppliers.create');
Route::post('suppliers/create' , [SupplierController::class , 'store'])->name('suppliers.store');
Route::get('suppliers/{id}/edit' , [SupplierController::class , 'edit'])->name('suppliers.edit');
Route::put('suppliers/{id}/edit' , [SupplierController::class , 'update'])->name('suppliers.update');
Route::delete('suppliers/{id}' , [SupplierController::class , 'destroy'])->name('suppliers.destroy');

// Purchase Route
Route::get('purchases' , [PurchaseController::class , 'index'])->name('purchases.index');
Route::get('purchases/create' , [PurchaseController::class , 'create'])->name('purchases.create');
Route::post('purchases/create' , [PurchaseController::class , 'store'])->name('purchases.store');
