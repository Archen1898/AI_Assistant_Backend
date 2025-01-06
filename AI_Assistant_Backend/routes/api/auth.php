<?php
//GLOBAL IMPORT
use Illuminate\Support\Facades\Route;

//LOCAL IMPORT
use App\Http\Controllers\v1\AuthController;

Route::controller(AuthController::class)->group(function(){
    Route::post('login','login')->name('login');
    Route::post('verify_token','verifyToken')->name('verify_token');
    Route::post('logout','logout')->name('logout');
    Route::post('register','register')->name('register');
});