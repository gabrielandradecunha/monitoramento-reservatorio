<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservatorioController;
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
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'showDashboard']);
    
    // Reservatorio Route
    Route::get('/reservatorio/{id}', [DashboardController::class, 'showReservatorio']);

    //Create Reservatorio Route
    Route::post('/createreservatorio/{id}', [DashboardController::class, 'createReservatorio']);

    //Delete Reservatorio Route
    Route::delete('/deletarreservatorio/{id}', [ReservatorioController::class, 'destroy']);

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
