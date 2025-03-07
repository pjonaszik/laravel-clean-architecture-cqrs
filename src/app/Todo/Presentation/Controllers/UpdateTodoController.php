<?php

declare(strict_types=1);

namespace App\Todo\Presentation\Controllers;

use App\Todo\Application\Bus\Command\CommandBus;
use App\Todo\Application\Commands\UpdateTodoCommand;
use App\Todo\Application\Data\UpdateTodoData;
use App\Todo\Presentation\Requests\UpdateTodoRequest;
use Illuminate\Http\JsonResponse;

readonly class UpdateTodoController
{
    public function __construct(private CommandBus $commandBus)
    {
    }
    public function __invoke(UpdateTodoRequest $request, string $id): JsonResponse
    {
        try {
            $updateData = UpdateTodoData::fromRequest($request, $id);
            $command = new UpdateTodoCommand($updateData);
            $id = $this->commandBus->dispatch($command);

            return response()->json(compact('id'));
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
