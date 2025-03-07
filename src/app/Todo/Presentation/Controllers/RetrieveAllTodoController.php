<?php

declare(strict_types=1);

namespace App\Todo\Presentation\Controllers;

use App\Todo\Application\Bus\Contracts\QueryBusContract;
use App\Todo\Application\Data\RetrieveAllTodoData;
use App\Todo\Application\Queries\RetrieveAllTodoQuery;
use App\Todo\Presentation\Requests\RetrieveAllTodoRequest;
use Illuminate\Http\JsonResponse;

readonly class RetrieveAllTodoController
{
    public function __construct(private QueryBusContract $queryBus)
    {
    }

    public function __invoke(RetrieveAllTodoRequest $request): JsonResponse
    {
        try {
            $queryData = RetrieveAllTodoData::fromRequest($request);
            $query = new RetrieveAllTodoQuery($queryData);
            $todos = $this->queryBus->ask($query);

            return response()->json($todos);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
