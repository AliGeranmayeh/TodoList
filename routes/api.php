<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Task\TaskController;




Route::post('register', [AuthenticationController::class , 'register'])->name('register');
Route::post('login', [AuthenticationController::class , 'login'])->name('login');
Route::post('logout', [AuthenticationController::class , 'logout'])->name('logout')->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('tasks', [TaskController::class , 'index'])->name('tasks.index');
    Route::post('tasks', [TaskController::class , 'store'])->name('tasks.store');
    Route::patch('tasks/{task}', [TaskController::class , 'update'])->name('tasks.update');
    Route::get('tasks/{task}', [TaskController::class , 'show'])->name('tasks.show');
    Route::delete('tasks/{task}', [TaskController::class , 'delete'])->name('tasks.delete');
});
