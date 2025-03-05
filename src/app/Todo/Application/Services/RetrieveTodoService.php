<?php

declare(strict_types=1);

namespace App\Todo\Application\Services;

use App\Todo\Application\DTOs\RetrieveTodoDTO;
use App\Todo\Domain\Repositories\TodoRepositoryInterface;

readonly class RetrieveTodoService
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {
    }

    public function handle(RetrieveTodoDTO $dto): ?array
    {
        $id = $dto->id;
        $criteria = [
            'title' => $dto->title,
            'completed' => $dto->completed,
        ];
        $todo = $this->todoRepository->retrieve($id, $criteria);
        return $todo?->toArray();
    }
}
