<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactMailController;
use App\Http\Controllers\ContactMobileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Contacts 
Route::apiResource('contacts', ContactController::class)->except("update")->except("destroy");
Route::put("/contacts", [ContactController::class, 'update'])->name("contacts.update");
Route::delete("/contacts", [ContactController::class, 'destroy'])->name("contacts.desrtoy");
// email & mobiles contact route
Route::group(['prefix' => '/contacts/{contact}'], function () {
    Route::apiResource('mails', ContactMailController::class)->except("update")->except("destroy");
    Route::put('/mails', [ContactMailController::class, 'update'])->name("mails.update");
    Route::delete('/mails', [ContactMailController::class, 'destroy'])->name("mails.destroy");
    Route::apiResource('mobiles', ContactMobileController::class)->except("update")->except("destroy");
    Route::put('/mobiles', [ContactMobileController::class, 'update'])->name("mobiles.update");
    Route::delete('/mobiles', [ContactMobileController::class, 'destroy'])->name("mobiles.destroy");
});