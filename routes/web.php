<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;


//Ruta para la vista de los usuarios
Route::get('/users', [SiteController::class, 'users'])->name('users');
//Ruta del formulario
Route::get('/form/{id?}', [SiteController::class, 'form'])->name('form');


