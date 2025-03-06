<?php

declare(strict_types=1);

namespace App\Todo\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Requests\Todo\UpdateTodoRequest;
use App\Todo\Application\DTOs\UpdateTodoDTO;
use App\Todo\Application\Services\UpdateTodoService;
use Illuminate\Http\JsonResponse;

class UpdateTodoController extends Controller
{
    public function __construct(private readonly UpdateTodoService $updateTodoService)
    {
    }
    public function __invoke(UpdateTodoRequest $request, string $id): JsonResponse
    {
        $dto = UpdateTodoDTO::fromRequest($id, $request);
        $todo = $this->updateTodoService->handle($dto);

        return response()->json($todo);
    }
}
