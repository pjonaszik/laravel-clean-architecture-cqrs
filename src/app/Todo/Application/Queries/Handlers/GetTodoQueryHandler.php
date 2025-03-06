<?php

declare(strict_types=1);

namespace App\Todo\Application\Queries\Handlers;

use App\Todo\Application\Bus\Query\QueryHandler;
use App\Todo\Application\Queries\GetTodoQuery;
use App\Todo\Application\Services\RetrieveTodoService;

class GetTodoQueryHandler extends QueryHandler
{
    public function __construct(
        private RetrieveTodoService $retrieveTodoService
    ) {
    }

    public function __invoke(GetTodoQuery $todoQuery): ?array
    {
        return $this->retrieveTodoService->retrieveTodo($todoQuery);
    }

}
