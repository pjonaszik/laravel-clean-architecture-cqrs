<?php

declare(strict_types=1);

namespace App\Todo\Application\Services;

use App\Todo\Application\DTOs\RetrieveTodoDTO;
use App\Todo\Application\DTOs\UpdateTodoDTO;
use App\Todo\Domain\Repositories\TodoRepositoryInterface;

readonly class UpdateTodoService
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {
    }

    public function handle(UpdateTodoDTO $dto): ?array
    {
        $update = [
            'title' => $dto->title,
            'description' => $dto->description,
            'completed' => $dto->completed,
        ];
        $todo = $this->todoRepository->update($dto->id, $update);
        return $todo?->toArray();
    }
}
