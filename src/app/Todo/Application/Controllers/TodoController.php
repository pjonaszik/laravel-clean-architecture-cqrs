<?php

declare(strict_types=1);

namespace App\Todo\Application\Controllers;

use App\Http\Controllers\Controller;
use App\Todo\Application\Requests\CreateRequest;
use App\Todo\Application\Requests\UpdateRequest;
use App\Todo\Application\Services\TodoService;
use App\Todo\Domain\Entities\Todo;
use Illuminate\Http\JsonResponse;

class TodoController extends Controller
{
    public function __construct(private readonly TodoService $todoService)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->todoService->getAll());
    }

    public function show(string $id): JsonResponse
    {
        $todo = $this->todoService->findById($id);
        return $todo ? response()->json($todo) : response()->json(['message' => 'Not found'], 404);
    }

    public function create(CreateRequest $request): JsonResponse
    {
        $todo = $this->todoService->create(
            title: $request->validated()['title'],
            description: $request->validated()['description'],
            dueDate: $request->validated()['due_date'],
        );

        return response()->json($todo);
    }

    public function update(UpdateRequest $request, $id): JsonResponse
    {
        $todo = $this->todoService->update(
            id: $id,
            title: $request->validated()['title'],
            description: $request->validated()['description'],
            dueDate: $request->validated()['due_date'],
            completed: $request->validated()['completed']
        );

        return $todo ? response()->json($todo) : response()->json(['message' => 'Not found'], 404);
    }

    public function destroy(string $id): JsonResponse
    {
        $this->todoService->delete($id);
        return response()->json(null, 204);
    }
}
