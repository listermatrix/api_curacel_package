<?php

use Illuminate\Support\Facades\Route;
use Jetstream\Curacel\Http\Controllers\CustomerController;

Route::get('test',[CustomerController::class,'index']);


Route::prefix('customer')->group(function (){
    Route::get('',[CustomerController::class,'index']);
    Route::get('{reference}',[CustomerController::class,'show']);
    Route::post('',[CustomerController::class,'create']);
});

