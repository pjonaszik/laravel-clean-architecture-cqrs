<?php

declare(strict_types=1);

namespace App\Todo\Application\Commands\Handlers;

use App\Todo\Application\Bus\Command\CommandHandler;
use App\Todo\Application\Commands\DeleteTodoCommand;
use App\Todo\Application\Services\DeleteTodoService;

final class DeleteTodoCommandHandler extends CommandHandler
{
    public function __construct(private readonly DeleteTodoService $deleteTodoService)
    {
    }

    public function __invoke(DeleteTodoCommand $command): mixed
    {
        return $this->deleteTodoService->delete($command->id);
    }
}
