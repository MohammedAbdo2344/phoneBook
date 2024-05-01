<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactMailController;
use App\Http\Controllers\ContactMobileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Contacts 
Route::apiResource('contacts', ContactController::class);

// email & mobiles contact route
Route::group(['prefix' => '/contacts/{contact}'],function(){
    Route::apiResource('mails', ContactMailController::class);
    Route::apiResource('mobiles', ContactMobileController::class);
});
