<?php

use App\Http\Controllers\BookController; use Illuminate\Support\Facades\Route; Route::middleware('auth:sanctum')->
    group(function () {
    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/{id}', [BookController::class, 'show']);
    Route::post('/books', [BookController::class, 'store'])->middleware('role:admin,editor');
    Route::put('/books/{id}', [BookController::class, 'update'])->middleware('role:admin,editor');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->middleware('role:admin');
    });