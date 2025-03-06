<?php

declare(strict_types=1);

namespace App\Todo\Application\Commands\Handlers;

use App\Todo\Application\Bus\Command\CommandHandler;
use App\Todo\Application\Commands\CreateTodoCommand;
use App\Todo\Application\Services\CreateTodoService;

final class CreateTodoCommandHandler extends CommandHandler
{
    public function __construct(private readonly CreateTodoService $createTodoService)
    {
    }

    public function __invoke(CreateTodoCommand $command): string
    {
        return $this->createTodoService->create($command->createTodoData);
    }
}
