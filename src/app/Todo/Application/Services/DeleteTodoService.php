<?php

declare(strict_types=1);

namespace App\Todo\Application\Services;

use App\Todo\Application\DTOs\DeleteTodoDTO;
use App\Todo\Domain\Repositories\TodoRepositoryInterface;

readonly class DeleteTodoService
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {
    }

    public function handle(DeleteTodoDTO $dto): bool
    {
        $id = $dto->id;
        $criteria = [
            'title' => $dto->title,
            'description' => $dto->description,
            'completed' => $dto->completed,
        ];
        return $this->todoRepository->delete($id, $criteria);
    }
}
