<?php

declare(strict_types=1);

namespace App\Todo\Infrastructure\Repositories;

use App\Todo\Domain\Entities\Todo;
use App\Todo\Domain\Repositories\TodoRepositoryInterface;
use App\Todo\Infrastructure\Models\TodoModel;
use Carbon\Carbon;

class TodoRepository implements TodoRepositoryInterface
{
    public function create(Todo $todo): Todo
    {
        $model = new TodoModel();
        $model->title = $todo->title;
        $model->description = $todo->description;
        $model->due_date = $todo->dueDate->format(DATE_RFC3339);
        $model->completed = $todo->completed;
        $model->save();

        return new Todo(
            $model->id,
            $model->title,
            $model->description,
            Carbon::parse($model->due_date)->toDateTimeImmutable(),
            $model->completed,
        );
    }

    public function retrieve(string $id, array $criteria): ?Todo
    {
        $todo = TodoModel::query();
        $todo->where('id', '=', $id);
        foreach ($criteria as $key => $value) {
            if ($value && $key === 'title') {
                $todo->where($key, 'LIKE', "%{$value}%");
            }
            if ($value && $key === 'completed') {
                $todo->where($key, (bool) $value);
            }
        }

        $todo = $todo->first();
        if (!$todo) {
            return null;
        }

        return new Todo(
            $todo->id,
            $todo->title,
            $todo->description,
            Carbon::parse($todo->due_date)->toDateTimeImmutable(),
            $todo->completed,
        );
    }

    public function update(string $id, array $update): ?Todo
    {
        $todo = TodoModel::find($id);
        if (!$todo) {
            return null;
        }
        if ($update['title']) {
            $todo->title = $update['title'];
        }
        if ($update['description']) {
            $todo->description = $update['description'];
        }
        if ($update['completed']) {
            $todo->completed = $update['completed'];
        }
        $todo->save();

        return new Todo(
            $todo->id,
            $todo->title,
            $todo->description,
            Carbon::parse($todo->due_date)->toDateTimeImmutable(),
            $todo->completed,
        );
    }

    public function delete(?string $id, ?array $criteria): bool
    {
        $todo = TodoModel::query();
        foreach ($criteria as $key => $value) {
            if ($id) {
                $todo->where('id', '=', $id);
            }
            if ($value && ($key === 'title' || $key === 'description')) {
                $todo->where($key, 'LIKE', "%{$value}%");
            }
            if ($value && $key === 'completed') {
                $todo->where($key, (bool) $value);
            }
        }

        return (bool) $todo->delete();
    }

    public function retrieveAll(array $criteria): array
    {
        $todos = TodoModel::query();
        foreach ($criteria as $key => $value) {
            if ($value && $key === 'completed') {
                $todos->where($key, (bool) $value);
            }
        }

        $todos = collect($todos->get());

        return $todos->map(function (TodoModel $todo) {
            return new Todo(
                $todo->id,
                $todo->title,
                $todo->description,
                Carbon::parse($todo->due_date)->toDateTimeImmutable(),
                $todo->completed,
            )->toArray();
        })->toArray();
    }
}
