<?php

declare(strict_types=1);

namespace App\Todo\Application\Services;

use App\Todo\Application\Queries\RetrieveTodoQuery;
use App\Todo\Domain\Repositories\TodoRepositoryInterface;

readonly class RetrieveTodoService
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {
    }

    public function retrieve(RetrieveTodoQuery $todoQuery): ?array
    {
        $queryData = $todoQuery->query;
        $id = $queryData->id;
        $criteria = [
            'title' => $queryData->title?->value,
            'completed' => $queryData->completed,
        ];
        $todo = $this->todoRepository->retrieve($id, $criteria);
        return $todo?->toArray();
    }
}
