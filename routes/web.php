<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MatriculaController;

// Rutas públicas
Route::view('/', 'login')->name('login');
Route::view('/registrar', 'register')->name('registrar');
Route::post('/register', [UserController::class, 'registrar'])->name('register');
Route::post('/identificacion', [UserController::class, 'verificalogin'])->name('identificacion');
Route::post('/verify-email-exists', [UserController::class, 'verifyEmailExists'])->name('verify.email.exists');
Route::get('/verify-email/{token}', [UserController::class, 'verifyEmailToken'])->name('verify.email.token');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {

    Route::get('/logout', [UserController::class, 'salir'])->name('logout');
    Route::view('/perfil', 'perfil');

    // Rutas protegidas por rol
    Route::middleware('role:estudiante')->group(function () {
        Route::get('/matricula',[MatriculaController::class, 'show'])->name('matricula');
        Route::post('/matricular',[MatriculaController::class, 'matricular'])->name('matricular');
    });
    Route::middleware('role:padreFamilia')->group(function () {

    });
    Route::middleware('role:docente')->group(function () {

    });
    Route::middleware('role:administrador')->group(function () {
        
    });
});