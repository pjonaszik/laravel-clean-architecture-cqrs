<?php

declare(strict_types=1);

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Requests\Todo\CreateTodoRequest;
use App\Todo\Application\Commands\CreateTodoCommand;
use Illuminate\Http\JsonResponse;

class CreateTodoController extends Controller
{
    public function __invoke(CreateTodoRequest $request): JsonResponse
    {
        try {
            $command = new CreateTodoCommand(
                title: $request->validated()['title'],
                description: $request->validated()['description'],
                dueDate: $request->validated()['due_date'],
            );
            $todo = dispatch_sync($command);

            return response()->json($todo);
        } catch (\Exception $e) {
//            report($exception);
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
