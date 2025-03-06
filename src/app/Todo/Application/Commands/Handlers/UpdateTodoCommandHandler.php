<?php

declare(strict_types=1);

namespace App\Todo\Application\Commands\Handlers;

use App\Todo\Application\Bus\Command\CommandHandler;
use App\Todo\Application\Commands\CreateTodoCommand;
use App\Todo\Application\Commands\UpdateTodoCommand;
use App\Todo\Application\Services\CreateTodoService;
use App\Todo\Application\Services\UpdateTodoService;

final class UpdateTodoCommandHandler extends CommandHandler
{
    public function __construct(private readonly UpdateTodoService $updateTodoService)
    {
    }

    public function __invoke(UpdateTodoCommand $command): string
    {
        return $this->updateTodoService->update($command->updateTodoData);
    }
}
