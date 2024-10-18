<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;


//Ruta principal, del login
Route::get('/', [SiteController::class,'login'])->name('login');

//Ruta para la vista de los usuarios
Route::resource('users', UserController::class);

//Ruta del formulario
Route::get('/form/{id?}', [SiteController::class, 'form'])->name('form');


