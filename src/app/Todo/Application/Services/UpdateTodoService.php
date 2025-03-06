<?php

declare(strict_types=1);

namespace App\Todo\Application\Services;

use App\Todo\Application\Data\UpdateTodoData;
use App\Todo\Domain\Repositories\TodoRepositoryInterface;
use App\Todo\Infrastructure\Events\TodoUpdatedEvent;

readonly class UpdateTodoService
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {
    }

    public function update(UpdateTodoData $updateTodoData): string
    {
        $update = [
            'title' => $updateTodoData->title?->value,
            'description' => $updateTodoData->description?->value,
            'due_date' => $updateTodoData->dueDate?->value,
            'completed' => $updateTodoData->completed,
        ];

        $id = $this->todoRepository->update($updateTodoData->id, $update);
        event(new TodoUpdatedEvent($id));

        return $id;
    }
}
