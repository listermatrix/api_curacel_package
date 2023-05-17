<?php

use Illuminate\Support\Facades\Route;
use Jetstream\Curacel\Http\Controllers\AttachmentController;
use Jetstream\Curacel\Http\Controllers\ClaimController;
use Jetstream\Curacel\Http\Controllers\CreditRequestController;
use Jetstream\Curacel\Http\Controllers\CustomerController;
use Jetstream\Curacel\Http\Controllers\PolicyController;
use Jetstream\Curacel\Http\Controllers\ProductController;
use Jetstream\Curacel\Http\Controllers\ProductPurchaseController;
use Jetstream\Curacel\Http\Controllers\QuotationActionController;
use Jetstream\Curacel\Http\Controllers\QuotationController;
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
        Route::get('list', [ProductPurchaseController::class, 'listOrders'])->name('products.orders.list');
        Route::get('{orderId}', [ProductPurchaseController::class, 'showOrder'])->name('products.orders.show');
        Route::post('authorize', [ProductPurchaseController::class, 'authorizeOrder'])->name('products.orders.authorize');
    });

});

Route::prefix('wallet')->group(function (){
    Route::post('top-up',[WalletController::class,'topUp'])->name('wallet.topup');
    Route::get('balance',[WalletController::class,'balance'])->name('wallet.balance');
    Route::get('transactions',[WalletController::class,'transactions'])->name('wallet.transactions');
});

/** to write test cases */
Route::prefix('policy')->group(function (){
    Route::get('',[PolicyController::class,'getCustomerPolicies'])->name('policy.list');
    Route::get('document/{id}',[PolicyController::class,'getPolicyDocument'])->name('policy.document');
    Route::get('resource/{identifier}',[PolicyController::class,'getPolicyResource'])->name('policy.resource');
});

Route::prefix('claims')->group(function (){
    Route::post('',[ClaimController::class,'create'])->name('claim.create');
    Route::get('',[ClaimController::class,'index'])->name('claim.list');
    Route::get('{id}',[ClaimController::class,'showClaim'])->name('claim.show');
    Route::put('update-voucher',[ClaimController::class,'updateVoucher'])->name('claim.voucher.update');
});


Route::prefix('attachment')->group(function (){
    Route::post('',[AttachmentController::class,'create'])->name('attachment.create');
    Route::get('{id}',[AttachmentController::class,'download'])->name('attachment.download');
});


Route::prefix('credit-requests')->group(function (){
    Route::get('',[CreditRequestController::class,'index'])->name('credit.index');
    Route::post('',[CreditRequestController::class,'create'])->name('credit.create');
    Route::get('markup-amount',[CreditRequestController::class,'getMarkAmount'])->name('credit.amount');
});


Route::prefix('quotation')->group(function (){
    Route::get('',[QuotationController::class,'index'])->name('quotation.index');
    Route::post('',[QuotationController::class,'create'])->name('quotation.create');
    Route::get('{quote}',[QuotationController::class,'show'])->name('quotation.show');
    Route::patch('{quote}',[QuotationController::class,'update'])->name('quotation.update');
    Route::delete('{quote}',[QuotationController::class,'delete'])->name('quotation.delete');

    Route::get('{quote}/download',[QuotationActionController::class,'downloadQuotationInvoice'])->name('quotation.downloadInvoice');
    Route::post('convert',[QuotationActionController::class,'convertQuotation'])->name('quotation.convert');
});


