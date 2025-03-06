<?php

declare(strict_types=1);

namespace App\Todo\Application\Services;

use App\Todo\Application\Queries\GetTodoQuery;
use App\Todo\Domain\Repositories\TodoRepositoryInterface;

readonly class RetrieveTodoService
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {
    }

    public function retrieveTodo(GetTodoQuery $todoQuery): ?array
    {
        $queryData = $todoQuery->getTodoQueryData;
        $id = $queryData->id;
        $criteria = [
            'title' => $queryData->title?->value,
            'completed' => $queryData->completed,
        ];
        $todo = $this->todoRepository->retrieve($id, $criteria);
        return $todo?->toArray();
    }
}
