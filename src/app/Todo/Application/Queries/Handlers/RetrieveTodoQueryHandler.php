<?php

declare(strict_types=1);

namespace App\Todo\Application\Queries\Handlers;

use App\Todo\Application\Bus\Query\QueryHandler;
use App\Todo\Application\Queries\RetrieveTodoQuery;
use App\Todo\Application\Services\RetrieveTodoService;

class RetrieveTodoQueryHandler extends QueryHandler
{
    public function __construct(
        private readonly RetrieveTodoService $todoService
    ) {
    }

    public function __invoke(RetrieveTodoQuery $query): ?array
    {
        return $this->todoService->retrieve($query);
    }

}
