<?php

declare(strict_types=1);

namespace App\Todo\Presentation\Controllers;

use App\Todo\Application\Bus\Contracts\CommandBusContract;
use App\Todo\Application\Commands\DeleteTodoCommand;
use Illuminate\Http\JsonResponse;

readonly class DeleteTodoController
{
    public function __construct(private CommandBusContract $commandBus)
    {
    }

    public function __invoke(string $id): JsonResponse
    {
        try {
            $command = new DeleteTodoCommand($id);
            $this->commandBus->dispatch($command);

            return response()->json(compact('id'));
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
