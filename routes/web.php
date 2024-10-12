<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/users', [SiteController::class, 'users'])->name('users');
Route::get('/form/{id?}', [SiteController::class, 'form'])->name('form');


