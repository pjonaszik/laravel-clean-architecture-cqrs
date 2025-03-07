<?php

declare(strict_types=1);

namespace App\Todo\Application\Queries\Handlers;

use App\Todo\Application\Bus\Query\QueryHandler;
use App\Todo\Application\Queries\RetrieveAllTodoQuery;
use App\Todo\Application\Services\RetrieveAllTodoService;

class RetrieveAllTodoQueryHandler extends QueryHandler
{
    public function __construct(
        private readonly RetrieveAllTodoService $todoService
    ) {
    }

    public function __invoke(RetrieveAllTodoQuery $query): ?array
    {
        return $this->todoService->retrieveAll($query);
    }

}
