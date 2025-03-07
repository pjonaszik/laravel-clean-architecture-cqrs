<?php

declare(strict_types=1);

namespace App\Todo\Domain\Listeners;

use App\Todo\Infrastructure\Events\TodoCreatedEvent;
use App\Todo\Infrastructure\Events\TodoDeletedEvent;
use App\Todo\Infrastructure\Events\TodoUpdatedEvent;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Log;

class TodoEventSubscriber
{
    public function handleTodoCreated(TodoCreatedEvent $id): void
    {
        Log::info("New Todo Created ID: " . $id);
    }
    public function handleTodoUpdated(TodoUpdatedEvent $id): void
    {
        Log::info("New Todo Updated ID: " . $id);
    }

    public function handleTodoDeleted(TodoDeletedEvent $id): void
    {
        Log::info("Todo Deleted ID: " . $id);
    }
    public function subscribe(Dispatcher $events): array
    {
        return [
            TodoCreatedEvent::class => 'handleTodoCreated',
            TodoUpdatedEvent::class => 'handleTodoUpdated',
            TodoDeletedEvent::class => 'handleTodoDeleted',
        ];
    }
}
