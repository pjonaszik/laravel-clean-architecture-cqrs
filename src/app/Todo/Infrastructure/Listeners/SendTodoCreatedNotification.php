<?php

declare(strict_types=1);

namespace App\Todo\Infrastructure\Listeners;

use App\Todo\Infrastructure\Events\TodoCreatedEvent;
use Illuminate\Support\Facades\Log;

class SendTodoCreatedNotification
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
    public function handle(TodoCreatedEvent $event): void
    {
        Log::info("New Todo Created ID: " . $event);
    }
}
