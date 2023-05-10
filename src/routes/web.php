<?php

use Illuminate\Support\Facades\Route;
use Jetstream\Curacel\Http\Controllers\CustomerController;
use Jetstream\Curacel\Http\Controllers\ProductController;
use Jetstream\Curacel\Http\Controllers\ProductPurchaseController;
use Jetstream\Curacel\Http\Controllers\WalletController;


Route::prefix('customer')->group(function (){
    Route::get('',[CustomerController::class,'index'])->name('customer.index');
    Route::get('{reference}',[CustomerController::class,'show'])->name('customer.show');
    Route::post('',[CustomerController::class,'create'])->name('customer.create');
    Route::delete('{reference}',[CustomerController::class,'delete'])->name('customer.delete');
});

Route::prefix('product')->group(function (){
    Route::get('types',[ProductController::class,'getProductTypes'])->name('product.types');
    Route::get('insurance',[ProductController::class,'getInsuranceProducts'])->name('product.insurance');
    Route::get('{id}',[ProductController::class,'showInsuranceProduct'])->name('product.show');

    Route::post('purchase',[ProductPurchaseController::class,'purchaseProduct'])->name('product.purchase');

    Route::prefix('orders')->group(function () {
        Route::get('/', [ProductPurchaseController::class, 'listOrders'])->name('products.orders.list');
        Route::get('{id}', [ProductPurchaseController::class, 'showOrder'])->name('products.orders.show');
        Route::post('authorize', [ProductPurchaseController::class, 'authorizeOrder'])->name('products.orders.authorize');
    });

});


Route::prefix('wallet')->group(function (){
    Route::get('types',[WalletController::class,'getProductTypes'])->name('wallet.types');
    Route::get('insurance',[WalletController::class,'getInsuranceProducts'])->name('wallet.insurance');
    Route::get('{reference}',[WalletController::class,'showInsuranceProduct'])->name('wallet.show');
});


