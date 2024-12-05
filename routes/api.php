<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('v1/employee/store', App\Http\Controllers\Employee\StoreController::class);
Route::post('v1/employee/update', App\Http\Controllers\Employee\UpdateController::class);
Route::get('v1/employee/{employeeID}', App\Http\Controllers\Employee\ShowByIDController::class);
Route::delete('v1/employee/{employeeID}', App\Http\Controllers\Employee\DeleteController::class);

Route::post('v1/position/store', App\Http\Controllers\Position\StoreController::class);
Route::post('v1/position/update', App\Http\Controllers\Position\UpdateController::class);
Route::delete('v1/position/{positionID}', App\Http\Controllers\Position\DeleteController::class);




