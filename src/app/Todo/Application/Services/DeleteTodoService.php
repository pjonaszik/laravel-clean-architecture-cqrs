<?php

declare(strict_types=1);

namespace App\Todo\Application\Services;

use App\Todo\Domain\Repositories\TodoRepositoryInterface;
use App\Todo\Infrastructure\Events\TodoDeletedEvent;

readonly class DeleteTodoService
{
    public function __construct(private TodoRepositoryInterface $todoRepository)
    {
    }

    public function delete(string $id): void
    {
        $this->todoRepository->delete($id);
        event(new TodoDeletedEvent($id));
    }
}
