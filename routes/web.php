<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\AdminController;

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
    Route::view('/perfil', 'perfil')->name('perfil');

    // Rutas protegidas por rol
    Route::middleware('role:estudiante')->group(function () {
        Route::get('/matricula',[MatriculaController::class, 'show'])->name('matricula');
        Route::post('/matricular',[MatriculaController::class, 'matricular'])->name('matricular');
        Route::get('/pago', [PagoController::class, 'showPago'])->name('pago');
        Route::post('/realizar-pago', [PagoController::class, 'realizarPago'])->name('realizarPago');
    });
    Route::middleware('role:padreFamilia')->group(function () {

    });
    Route::middleware('role:docente')->group(function () {

    });
    Route::middleware('role:administrador')->group(function () {
        // Administración de usuarios
        Route::get('/admin/users', [AdminController::class, 'usersIndex'])->name('admin.users.index');
        Route::post('/admin/users', [AdminController::class, 'usersStore'])->name('admin.users.store');
        Route::post('/admin/users/{user}/verify', [AdminController::class, 'usersVerify'])->name('admin.users.verify');
        Route::post('/admin/users/{user}/block', [AdminController::class, 'usersBlock'])->name('admin.users.block');

        // Administración de cursos
        Route::get('/admin/cursos', [AdminController::class, 'cursosIndex'])->name('admin.cursos.index');
        Route::post('/admin/cursos', [AdminController::class, 'cursosStore'])->name('admin.cursos.store');
        Route::post('/admin/cursos/{idCurso}/delete', [AdminController::class, 'cursosDelete'])->name('admin.cursos.delete');

        // Administración de matrículas
        Route::get('/admin/matriculas', [MatriculaController::class, 'adminIndex'])->name('admin.matriculas.index');
        Route::post('/admin/matriculas/plazo', [MatriculaController::class, 'guardarPlazo'])->name('admin.matriculas.plazo');
        Route::put('/admin/matriculas/{idMatricula}/estado', [MatriculaController::class, 'actualizarEstado'])->name('admin.matriculas.estado');
        
        // Administración de pagos
        Route::get('/admin/pagos', [AdminController::class, 'pagosIndex'])->name('admin.pagos.index');
        Route::put('/admin/pagos/{idPago}/estado', [AdminController::class, 'pagosActualizarEstado'])->name('admin.pagos.estado');
        
    // Gestión de horarios
    Route::get('/admin/horarios', [AdminController::class, 'horariosIndex'])->name('admin.horarios.index');
    Route::post('/admin/horarios', [AdminController::class, 'horariosStore'])->name('admin.horarios.store');
    Route::put('/admin/horarios/{idHorario}', [AdminController::class, 'horariosUpdate'])->name('admin.horarios.update');
    Route::post('/admin/horarios/{idHorario}/delete', [AdminController::class, 'horariosDelete'])->name('admin.horarios.delete');
    });
});