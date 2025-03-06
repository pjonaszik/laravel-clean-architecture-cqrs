<?php

declare(strict_types=1);

namespace App\Todo\Presentation\Controllers;

use App\Todo\Application\Bus\Contracts\QueryBusContract;
use App\Todo\Application\Data\GetTodoQueryData;
use App\Todo\Application\Queries\GetTodoQuery;
use App\Todo\Presentation\Requests\RetrieveTodoRequest;
use Illuminate\Http\JsonResponse;

readonly class RetrieveTodoController
{
    public function __construct(
        private QueryBusContract $queryBus
    ) {
    }
    public function __invoke(RetrieveTodoRequest $request): JsonResponse
    {
        try {
            $queryData = GetTodoQueryData::fromRequest($request);
            $query = new GetTodoQuery($queryData);
            $todo = $this->queryBus->ask($query);

            return response()->json($todo);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400, );
        }
    }
}
