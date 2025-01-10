<?php

//GLOBAL IMPORT
use Illuminate\Support\Facades\Route;


require __DIR__ . '/api/auth.php';

Route::middleware('auth:api')->group(function () {

    require __DIR__ . '/api/balance.php';
    require __DIR__ . '/api/expense.php';
    require __DIR__ . '/api/income.php';
    require __DIR__ . '/api/user.php';
    require __DIR__ . '/api/income_type.php';
    require __DIR__ . '/api/expense_type.php';

});