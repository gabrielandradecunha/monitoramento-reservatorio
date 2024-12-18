<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
//Chamando manualmente o middleware de autenticação de usuario
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function() {
    return view('home');
});

Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->middleware('auth');

/* O usuario tera que passar por duas middlewares par acessar essas rotas*/
Route::get('/users', [UserController::class, 'getUsers'])->middleware('auth', AdminMiddleware::class);
Route::get('/deleteuser/{id}', [UserController::class, 'destroy'])->middleware('auth', AdminMiddleware::class);
Route::post('/createuser', [UserController::class, 'create'])->middleware('auth', AdminMiddleware::class);

Route::get('/reservatorio/{id}', [DashboardController::class, 'showReservatorio'])->middleware('auth', AdminMiddleware::class);
