<?php

declare(strict_types=1);

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Requests\Todo\RetrieveAllTodoRequest;
use App\Todo\Application\DTOs\RetrieveAllTodoDTO;
use App\Todo\Application\Services\RetrieveAllTodoService;
use Illuminate\Http\JsonResponse;

class RetrieveAllTodoController extends Controller
{
    public function __construct(private readonly RetrieveAllTodoService $retrieveAllTodoService)
    {
    }
    public function __invoke(RetrieveAllTodoRequest $request): JsonResponse
    {
        $dto = RetrieveAllTodoDTO::fromRequest($request);
        $todo = $this->retrieveAllTodoService->handle($dto);

        return response()->json($todo);
    }
}
