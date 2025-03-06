<?php

declare(strict_types=1);

namespace App\Todo\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Requests\Todo\DeleteTodoRequest;
use App\Todo\Application\DTOs\DeleteTodoDTO;
use App\Todo\Application\Services\DeleteTodoService;
use Illuminate\Http\JsonResponse;

class DeleteTodoController extends Controller
{
    public function __construct(private readonly DeleteTodoService $deleteTodoService)
    {
    }
    public function __invoke(DeleteTodoRequest $request, ?string $id): JsonResponse
    {
        $dto = DeleteTodoDTO::fromRequest($id, $request);
        $todo = $this->deleteTodoService->handle($dto);

        return response()->json($todo);
    }
}
