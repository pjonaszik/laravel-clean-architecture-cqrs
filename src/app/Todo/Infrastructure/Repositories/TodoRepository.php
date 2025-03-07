<?php

declare(strict_types=1);

namespace App\Todo\Infrastructure\Repositories;

use App\Todo\Application\Data\CreateTodoData;
use App\Todo\Domain\Entities\Todo;
use App\Todo\Domain\Repositories\TodoRepositoryInterface;
use App\Todo\Infrastructure\Models\TodoModel;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TodoRepository implements TodoRepositoryInterface
{
    public function create(CreateTodoData $createTodoData): string
    {
        $model = new TodoModel();
        $model->title = $createTodoData->title->value;
        $model->description = $createTodoData->description->value;
        $model->due_date = Carbon::parse($createTodoData->dueDate->value)
            ->toDateTimeImmutable()->format(\DateTimeInterface::RFC3339);
        $model->completed = $createTodoData->completed;
        $model->save();

        return $model->id;
        //        return Todo::fromModel($model);
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
            throw new NotFoundHttpException('Todo not found', code: 404);
        }

        return Todo::fromModel($todo);
    }

    public function update(string $id, array $update): string
    {
        try {
            $todo = TodoModel::find($id);
            if (!$todo) {
                throw new NotFoundHttpException('Todo not found.', code: 404);
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

            return $id;
        } catch (\Exception|\Throwable $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }

    public function delete(string $id): void
    {
        $todo = TodoModel::find($id);
        if (!$todo) {
            throw new NotFoundHttpException('Todo not found', code: 404);
        }
        $todo->delete();
    }

    public function retrieveAll(?array $criteria): array
    {
        $todos = TodoModel::query();
        if ($criteria) {
            foreach ($criteria as $key => $value) {
                if ($value && $key === 'title') {
                    $todos->where($key, 'LIKE', $value);
                }
                if ($value && $key === 'completed') {
                    $todos->where($key, (bool) $value);
                }
            }
        }
        $todos = collect($todos->limit(25)->get());

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
