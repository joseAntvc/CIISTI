<?php

use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Ruta para la vista de los usuarios
Route::resource('users', UserController::class);

//Ruta del formulario
Route::get('/form/{id?}', [SiteController::class, 'form'])->name('form');


