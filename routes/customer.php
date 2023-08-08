<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Customer\CustomerController;





/************************************* IBEDC ALTERNATE PAYMENT SYSTEM **************************************************/
Route::group(['prefix' => 'ibedc_alternate_endpoints'], function () {
    Route::middleware(['before', 'after', 'throttle:60,1'])->group(function () {

         Route::apiResource('customers', CustomerController::class);

    });
});


