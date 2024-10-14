<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;


Route::get('/users', [SiteController::class, 'users'])->name('users');
Route::get('/form/{id?}', [SiteController::class, 'form'])->name('form');


