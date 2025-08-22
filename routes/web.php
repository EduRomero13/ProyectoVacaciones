<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::view('/','login')->name('login');
Route::view('/registrar','register')->name('registrar');
Route::post('/identificacion', [UserController::class,'verificalogin'])->name('identificacion');
//Rutas protegidas por el middleware de autenticación
Route::middleware('auth')->group(function () {
    Route::view('/welcome','welcome');
    Route::get('/logout', [UserController::class,'salir'])->name('logout');
});

