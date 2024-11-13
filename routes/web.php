<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;

// Mostrar el formulario de login (GET)
Route::get('/', [SiteController::class, 'login'])->name('login');

// Procesar el formulario de login (POST)
Route::post('/', [AuthController::class, 'login']);

//Ruta para la vista de los usuarios
Route::resource('users', UserController::class);

//Ruta para la vista de eventos
Route::resource('events', EventController::class);

//Ruta del formulario
Route::get('/email/form', [SiteController::class, 'form'])->name('form');
Route::post('/email', [SiteController::class, 'email'])->name('email');

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('users', [UserController::class, 'index'])
    ->middleware('auth')
    ->name('users');

Route::get('events', [EventController::class, 'index'])
    ->middleware('auth')
    ->name('events');

    Route::get('events/filter/{id}', [EventController::class, 'filter'])
    ->middleware('auth')
    ->name('eventsFilter');

Route::get('/events/{id}/moderators', [EventController::class, 'getModerators'])->name('getModerators');
Route::post('/events/{id}/update-moderators', [EventController::class, 'updateModerators'])->name('events.updateModerators');


