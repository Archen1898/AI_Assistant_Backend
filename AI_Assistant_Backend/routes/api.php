<?php

//GLOBAL IMPORT
use Illuminate\Support\Facades\Route;


require __DIR__ . '/api/auth.php';

Route::middleware('auth:api')->group(function () {

    require __DIR__ . '/api/balances.php';
    require __DIR__ . '/api/expenses.php';
    require __DIR__ . '/api/incomes.php';
    require __DIR__ . '/api/users.php';
    require __DIR__ . '/api/income_type.php';
    require __DIR__ . '/api/expense_type.php';

});