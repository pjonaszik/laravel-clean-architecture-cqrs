<?php

declare(strict_types=1);

namespace App\Todo\Presentation\Controllers;

use App\Todo\Application\Bus\Contracts\QueryBusContract;
use App\Todo\Application\Data\RetrieveTodoData;
use App\Todo\Application\Queries\RetrieveTodoQuery;
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
            $queryData = RetrieveTodoData::fromRequest($request);
            $query = new RetrieveTodoQuery($queryData);
            $todo = $this->queryBus->ask($query);

            return response()->json($todo);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 400, );
        }
    }
}
