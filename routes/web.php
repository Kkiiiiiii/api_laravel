<?php

use App\Http\Controllers\UserController as ControllersUserController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/users',[UsersController::class, 'index'])->name('users.index');
Route::get('/users/export',[UsersController::class, 'export'])->name('users.export');
