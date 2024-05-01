<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactMailController;
use App\Http\Controllers\ContactMobileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Contacts 
Route::get('contacts',[ContactController::class,'index'])->name("contacts.index");
Route::get('contacts/{id}',[ContactController::class,'show'])->name("contacts.show");

Route::post('contacts',[ContactController::class,'store'])->name("contacts.store");

Route::delete('contacts/{id}',[ContactController::class,'destroy'])->name("contacts.destroy");

Route::put('contacts/{id}',[ContactController::class,'update'])->name("contacts.update");

// email
Route::get('contacts/{contact_id}/mails',[ContactMailController::class,'index'])->name("contacts.mail.index");
Route::get('contacts/{contact_id}/mails/{id}',[ContactMailController::class,'show'])->name("contacts.mail.show");

Route::post('contacts/{contact_id}/mails',[ContactMailController::class,'store'])->name("contacts.mail.store");

Route::delete('contacts/{contact_id}/mails/{id}',[ContactMailController::class,'destroy'])->name("contacts.mail.destroy");

Route::put('contacts/{contact_id}/mails/{id}',[ContactMailController::class,'update'])->name("contacts.mail.update");

// mobile
Route::get('contacts/{contact_id}/mobiles',[ContactMobileController::class,'index'])->name("contacts.mobile.index");
Route::get('contacts/{contact_id}/mobiles/{id}',[ContactMobileController::class,'show'])->name("contacts.mobile.show");

Route::post('contacts/{contact_id}/mobiles',[ContactMobileController::class,'store'])->name("contacts.mobile.store");

Route::put('contacts/{contact_id}/mobiles/{id}',[ContactMobileController::class,'update'])->name("contacts.mobile.update");

Route::delete('contacts/{contact_id}/mobiles/{id}',[ContactMobileController::class,'destroy'])->name("contacts.mobile.destroy");
