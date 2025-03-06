<?php

declare(strict_types=1);

namespace App\Todo\Presentation\Controllers;

use App\Todo\Application\Bus\Contracts\CommandBusContract;
use App\Todo\Application\Commands\CreateTodoCommand;
use App\Todo\Application\Data\CreateTodoData;
use App\Todo\Presentation\Requests\CreateTodoRequest;
use Illuminate\Http\JsonResponse;

readonly class CreateTodoController
{
    public function __construct(
        private CommandBusContract $commandBus,
    ) {
    }
    public function __invoke(CreateTodoRequest $request): JsonResponse
    {
        try {
            $createTodoData = CreateTodoData::fromRequest($request);
            $command = new CreateTodoCommand($createTodoData);
            $id = $this->commandBus->dispatch($command);

            return response()->json(compact('id'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
