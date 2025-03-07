<?php

declare(strict_types=1);

use App\Todo\Presentation\Controllers\CreateTodoController;
use App\Todo\Presentation\Controllers\DeleteTodoController;
use App\Todo\Presentation\Controllers\RetrieveAllTodoController;
use App\Todo\Presentation\Controllers\RetrieveTodoController;
use App\Todo\Presentation\Controllers\UpdateTodoController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/todos', [RetrieveAllTodoController::class, '__invoke']);
    Route::get('/todos/{id}', [RetrieveTodoController::class, '__invoke']);
    Route::post('/todos', [CreateTodoController::class, '__invoke']);
    Route::put('/todos/{id}', [UpdateTodoController::class, '__invoke']);
    Route::delete('/todos/{id}', [DeleteTodoController::class, '__invoke']);
});
