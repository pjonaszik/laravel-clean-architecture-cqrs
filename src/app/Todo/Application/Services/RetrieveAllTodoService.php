<?php

declare(strict_types=1);

namespace App\Todo\Application\Services;

use App\Todo\Application\DTOs\RetrieveAllTodoDTO;
use App\Todo\Domain\Repositories\TodoRepositoryInterface;

readonly class RetrieveAllTodoService
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {
    }

    public function handle(RetrieveAllTodoDTO $dto): ?array
    {
        $criteria = [
            'completed' => $dto->completed,
        ];
        return $this->todoRepository->retrieveAll($criteria);
    }
}
