<?php

declare(strict_types=1);

namespace App\Todo\Domain\Listeners;

use App\Todo\Infrastructure\Events\TodoCreatedEvent;
use App\Todo\Infrastructure\Events\TodoUpdatedEvent;
use Illuminate\Support\Facades\Log;

class SendTodoUpdatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TodoUpdatedEvent $event): void
    {
        Log::info("New Todo Updated ID: " . $event);
    }
}
