<?php

declare(strict_types=1);

namespace App\Todo\Application\Services;

use App\Todo\Domain\Entities\Todo;
use App\Todo\Domain\Repositories\TodoRepositoryInterface;
use App\Todo\Domain\ValueObjects\DueDate;
use App\Todo\Domain\ValueObjects\TaskDescription;
use App\Todo\Domain\ValueObjects\TaskTitle;

readonly class TodoService
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {
    }

    public function create(string $title, string $description, string $dueDate): array
    {
        $todo = new Todo(
            null,
            new TaskTitle($title),
            new TaskDescription($description),
            new DueDate($dueDate),
        );

        return $this->todoRepository->save($todo);
    }

    public function getAll(): array
    {
        return $this->todoRepository->getAll();
    }

    public function findById(string $id): array
    {
        return $this->todoRepository->findById($id);
    }

    public function update(string $id, ?string $title, ?string $description, ?string $dueDate, ?bool $completed): ?array
    {
        $todo = $this->todoRepository->findById($id);
        if (!$todo) {
            return null;
        }

        $todo = new Todo(
            $id,
            new TaskTitle($title ?? $todo->title->value),
            new TaskDescription($description ?? $todo->description->value),
            new DueDate($dueDate ?? $todo->dueDate->value),
            (bool) $completed ?? $todo->completed
        );
        return $this->todoRepository->save($todo);
    }

    public function delete(string $id): void
    {
        $this->todoRepository->delete($id);
    }
}
