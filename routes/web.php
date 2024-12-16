<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function() {
    return view('home');
});

Route::get('/showlogin', [LoginController::class, 'showLoginForm']);
Route::post('/loginpost', [LoginController::class, 'login']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');