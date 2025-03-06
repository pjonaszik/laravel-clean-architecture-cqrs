<?php

declare(strict_types=1);

use App\Http\Controllers\Todo\UpdateTodoController;
use App\Http\Controllers\Todo\DeleteTodoController;
use App\Http\Controllers\Todo\RetrieveAllTodoController;
use App\Todo\Presentation\Controllers\CreateTodoController;
use App\Todo\Presentation\Controllers\RetrieveTodoController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/todos', [RetrieveAllTodoController::class, '__invoke']);
    Route::get('/todos/{id}', [RetrieveTodoController::class, '__invoke']);
    Route::post('/todos', [CreateTodoController::class, '__invoke']);
    Route::put('/todos/{id}', [UpdateTodoController::class, '__invoke']);
    Route::delete('/todos/{id?}', [DeleteTodoController::class, '__invoke']);
});
