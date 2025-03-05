<?php

declare(strict_types=1);

use App\Http\Controllers\Todo\CreateTodoController;
use App\Http\Controllers\Todo\RetrieveTodoController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
//    Route::get('/todos', [TodoController::class, 'index']);
    Route::get('/todos/{id}', [RetrieveTodoController::class, '__invoke']);
    Route::post('/todos', [CreateTodoController::class, '__invoke']);
//    Route::put('/todos/{id}', [TodoController::class, 'update']);
//    Route::delete('/todos/{id}', [TodoController::class, 'destroy']);
});
