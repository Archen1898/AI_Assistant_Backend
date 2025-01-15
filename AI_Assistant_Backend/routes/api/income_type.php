<?php
//GLOBAL IMPORT
use Illuminate\Support\Facades\Route;

//LOCAL IMPORT
use App\Http\Controllers\IncomeTypeController;

Route::controller(IncomeTypeController::class)->group(function(){
    Route::get('income_type/index','indexIncomeTypes')->middleware('permission:List Income Types');
    Route::get('income_type/status/{status}','indexIncomeTypesByStatus')->middleware('permission:List Income Types By Status');
    Route::post('income_type/add','createIncomeType')->middleware('permission:Create Income Type');
    Route::put('income_type/update/{id}','updateIncomeType')->middleware('permission:Update Income Type');
});