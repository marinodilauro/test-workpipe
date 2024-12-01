<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index'])->name('home');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');


Route::resource('/users', UserController::class);
