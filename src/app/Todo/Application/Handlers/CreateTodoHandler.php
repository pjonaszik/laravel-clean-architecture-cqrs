<?php

declare(strict_types=1);

namespace App\Todo\Application\Handlers;

use App\Todo\Application\Commands\CreateTodoCommand;
use App\Todo\Application\Services\CreateTodoService;
use App\Todo\Domain\Entities\Todo;

class CreateTodoHandler
{

    public function __construct(readonly CreateTodoService $createTodoService)
    {
    }

    public function handle(CreateTodoCommand $command): Todo
    {
        return $this->createTodoService->handle(
            title: $command->title,
            description: $command->description,
            dueDate: $command->dueDate,
            completed: $command->completed,
        );
    }
}
