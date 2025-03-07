<?php

declare(strict_types=1);

namespace App\Todo\Application\Services;

use App\Todo\Application\Queries\RetrieveAllTodoQuery;
use App\Todo\Domain\Repositories\TodoRepositoryInterface;

readonly class RetrieveAllTodoService
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {
    }

    public function retrieveAll(RetrieveAllTodoQuery $query): ?array
    {
        $query = $query->query;
        $criteria = [
            'title' => $query->title?->value ?? null,
            'completed' => $query->completed ?? null,
        ];

        return $this->todoRepository->retrieveAll($criteria);
    }
}
