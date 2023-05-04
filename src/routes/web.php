<?php

use Illuminate\Support\Facades\Route;
use Jetstream\Curacel\Http\Controllers\CustomerController;


Route::prefix('customer')->group(function (){
    Route::get('',[CustomerController::class,'index']);
    Route::get('{reference}',[CustomerController::class,'show']);
    Route::post('',[CustomerController::class,'create']);
});

