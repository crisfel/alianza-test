<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $user = Auth::user();
    if (isset($user)) {
        return view('home');
    }
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/positions', App\Http\Controllers\Position\ShowAllController::class)->name('position.index');
Route::get('/employees', App\Http\Controllers\Employee\ShowAllController::class)->name('employee.index');
