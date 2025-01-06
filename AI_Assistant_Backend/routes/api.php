<?php

//GLOBAL IMPORT
use Illuminate\Support\Facades\Route;


require __DIR__ . '/api/v1/auth.php';

Route::middleware('auth:api')->prefix('v1')->middleware('setLocale')->group(function () {


});