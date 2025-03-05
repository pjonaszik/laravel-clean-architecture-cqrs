<?php

declare(strict_types=1);

namespace App\Todo\Application\Services;

use App\Todo\Application\DTOs\CreateTodoDTO;
use App\Todo\Domain\Entities\Todo;
use App\Todo\Domain\Repositories\TodoRepositoryInterface;

readonly class CreateTodoService
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {
    }

    /**
     * @throws \DateMalformedStringException
     */
    public function handle(CreateTodoDTO $dto): array
    {
        $todo = new Todo(
            id: null,
            title: $dto->title,
            description: $dto->description,
            dueDate: new \DateTimeImmutable($dto->dueDate),
            completed: $dto->completed,
        );

        $createdTodo = $this->todoRepository->create($todo);
        return $createdTodo->toArray();
    }
}
