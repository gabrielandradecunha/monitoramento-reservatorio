<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservatorioController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\LixeiraController;
use App\Http\Middleware\AdminMiddleware;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function() {
    return view('home');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'showDashboard']);

    //Lixeira Route
    Route::get('/lixeira', [LixeiraController::class, 'showLixeira']);


    // Reservatorio Route
    Route::get('/reservatorio/{id}', [ReservatorioController::class, 'showReservatorio']);

    //Create Reservatorio Route
    Route::post('/createreservatorio/{id}', [DashboardController::class, 'createReservatorio']);

    //Update Reservatorio Route
    Route::post('/updatereservatorio/{id}', [ReservatorioController::class, 'update']);

    //Delete Reservatorio Route
    Route::delete('/deletarreservatorio/{id}', [ReservatorioController::class, 'destroy']);




    //Perfil Route
    Route::get('/perfil/{id}', [PerfilController::class, 'showPerfil'])->name('perfil');

    //Update Perfil Route
    Route::put('/editarperfil/{id}', [PerfilController::class, 'update']);

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(AdminMiddleware::class)->group(function () {

        // User Management Routes
        Route::get('/users', [UserController::class, 'getUsers']);
        Route::get('/deleteuser/{id}', [UserController::class, 'destroy']);
        Route::post('/createuser', [UserController::class, 'create']);
    });
});
