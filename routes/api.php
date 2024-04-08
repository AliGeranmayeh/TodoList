<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationController;




Route::post('register', [AuthenticationController::class , 'register'])->name('register');
Route::post('login', [AuthenticationController::class , 'login'])->name('login');