<?php

declare(strict_types=1);

namespace App\Todo\Application\Services;

use App\Events\TodoCreatedEvent;
use App\Todo\Domain\Entities\Todo;
use App\Todo\Domain\Repositories\TodoRepositoryInterface;
use App\Todo\Domain\ValueObjects\TaskDescription;
use App\Todo\Domain\ValueObjects\TaskDueDate;
use App\Todo\Domain\ValueObjects\TaskTitle;

readonly class CreateTodoService
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {
    }

    public function handle(
        string $title,
        string $description,
        string $dueDate,
        bool $completed = false,
    ): Todo
    {
        $todo = new Todo(
            id: null,
            title: new TaskTitle($title),
            description: new TaskDescription($description),
            dueDate: new TaskDueDate($dueDate),
            completed: $completed,
        );

        $todo = $this->todoRepository->create($todo);
        event(new TodoCreatedEvent($todo));

        return $this->todoRepository->create($todo);
    }
}
