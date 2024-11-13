<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\TaskController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/', function () {
        return Inertia::render('Tasks');
    })->name('tasks');

});

Route::get('/tasks/list', [TaskController::class, 'list']);
Route::post('/tasks/store', [TaskController::class, 'store']);
Route::post('/tasks/delete', [TaskController::class, 'delete']);
Route::post('/tasks/complete', [TaskController::class, 'update']);
