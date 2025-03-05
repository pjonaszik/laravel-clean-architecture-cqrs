<?php

declare(strict_types=1);

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Requests\Todo\CreateTodoRequest;
use App\Todo\Application\DTOs\CreateTodoDTO;
use App\Todo\Application\Services\CreateTodoService;
use Illuminate\Http\JsonResponse;

class CreateTodoController extends Controller
{
    public function __construct(private readonly CreateTodoService $createTodoService)
    {
    }

    public function __invoke(CreateTodoRequest $request): JsonResponse
    {
        $dto = CreateTodoDTO::fromRequest($request);
        $todo = $this->createTodoService->handle($dto);

        return response()->json($todo);
    }
}
