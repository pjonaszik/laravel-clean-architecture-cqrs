<?php

declare(strict_types=1);

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Requests\Todo\RetrieveTodoRequest;
use App\Todo\Application\DTOs\RetrieveTodoDTO;
use App\Todo\Application\Services\RetrieveTodoService;
use Illuminate\Http\JsonResponse;

class RetrieveTodoController extends Controller
{
    public function __construct(private readonly RetrieveTodoService $retrieveTodoService)
    {
    }
    public function __invoke(RetrieveTodoRequest $request, string $id): JsonResponse
    {
        $dto = RetrieveTodoDTO::fromRequest($id, $request);
        $todo = $this->retrieveTodoService->handle($dto);

        return response()->json($todo);
    }
}
