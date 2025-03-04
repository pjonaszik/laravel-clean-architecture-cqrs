<?php

declare(strict_types=1);

namespace App\Todo\Infrastructure\Repositories;

use App\Todo\Domain\Entities\Todo;
use App\Todo\Domain\Repositories\TodoRepositoryInterface;
use App\Todo\Domain\ValueObjects\DueDate;
use App\Todo\Domain\ValueObjects\TaskDescription;
use App\Todo\Domain\ValueObjects\TaskTitle;
use App\Todo\Infrastructure\Models\TodoModel;

class TodoRepository implements TodoRepositoryInterface
{
    public function getAll(): array
    {
        return TodoModel::all()->map(fn ($todo) => $this->mapToDomain($todo))->toArray();
    }

    /**
     * @throws \Exception
     */
    public function findById(string $id): array
    {
        $todo = TodoModel::find($id);

        if (!$todo) {
            throw new \Exception("Todo not found with ID: $id", 400);
        }

        return $this->mapToDomain($todo);
    }

    public function save(Todo $todo): array
    {
        $todoModel = $todo->id ? TodoModel::find($todo->id) : new TodoModel();
        $todoModel->title = $todo->title->value;
        $todoModel->description = $todo->description->value;
        $todoModel->due_date = $todo->dueDate->value;
        $todoModel->completed = $todo->completed;
        $todoModel->save();

        return $this->mapToDomain($todoModel);
    }

    public function delete(string $id): void
    {
        TodoModel::destroy($id);
    }

    private function mapToDomain(TodoModel $todoModel): array
    {
        return new Todo(
            $todoModel->id,
            new TaskTitle($todoModel->title),
            new TaskDescription($todoModel->description),
            new DueDate($todoModel->due_date),
            $todoModel->completed
        )->toArray();
    }
}
