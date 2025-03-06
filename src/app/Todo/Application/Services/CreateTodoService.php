<?php

declare(strict_types=1);

namespace App\Todo\Application\Services;

use App\Todo\Application\Contracts\TodoServiceContract;
use App\Todo\Application\Data\CreateTodoData;
use App\Todo\Domain\Repositories\TodoRepositoryInterface;
use App\Todo\Infrastructure\Events\TodoCreatedEvent;

readonly class CreateTodoService implements TodoServiceContract
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {
    }

    public function create(
        CreateTodoData $createTodoData
    ): string {
        $id = $this->todoRepository->create($createTodoData);
        event(new TodoCreatedEvent($id));

        return $id;
    }
}
