<?php

declare(strict_types=1);

namespace App\Todo\Application\Commands\Handlers;

use App\Todo\Application\Bus\Command\CommandHandler;
use App\Todo\Application\Commands\CreateTodoCommand;
use App\Todo\Application\Contracts\TodoServiceContract;
use App\Todo\Domain\Entities\Todo;

final class CreateTodoCommandHandler extends CommandHandler
{
    public function __construct(private readonly TodoServiceContract $todoService)
    {
    }

    public function handle(CreateTodoCommand $command): Todo
    {
        return $this->todoService->create($command->createTodoData);
    }

}
