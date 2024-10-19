<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;

// Mostrar el formulario de login (GET)
Route::get('/', [SiteController::class, 'login'])->name('login');

// Procesar el formulario de login (POST)
Route::post('/', [AuthController::class, 'login']);

//Ruta para la vista de los usuarios
Route::resource('users', UserController::class);

//Ruta del formulario
Route::get('/form/{id?}', [SiteController::class, 'form'])->name('form');

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('users', [UserController::class, 'index'])
    ->middleware('auth')
    ->name('users');
