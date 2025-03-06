<?php

declare(strict_types=1);

namespace App\Todo\Application\Handlers;

use App\Todo\Application\Commands\CreateTodoCommand;
use App\Todo\Application\Services\CreateTodoService;

readonly class CreateTodoHandler
{
    public function __construct(public CreateTodoService $createTodoService)
    {
    }

    public function __invoke(CreateTodoCommand $command): string
    {
        return $this->createTodoService->create($command->createTodoData);
    }
}
