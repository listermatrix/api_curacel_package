<?php

use Illuminate\Support\Facades\Route;
use Jetstream\Curacel\Http\Controllers\CustomerController;
use Jetstream\Curacel\Http\Controllers\ProductController;


Route::prefix('customer')->group(function (){
    Route::get('',[CustomerController::class,'index'])->name('customer.index');
    Route::get('{reference}',[CustomerController::class,'show'])->name('customer.show');
    Route::post('',[CustomerController::class,'create'])->name('customer.create');
    Route::delete('{reference}',[CustomerController::class,'delete'])->name('customer.delete');
});

Route::prefix('product')->group(function (){
    Route::get('types',[ProductController::class,'getProductTypes'])->name('product.types');
    Route::get('insurance',[ProductController::class,'getInsuranceProducts'])->name('product.insurance');
    Route::get('{reference}',[ProductController::class,'showInsuranceProduct'])->name('product.show');
});

