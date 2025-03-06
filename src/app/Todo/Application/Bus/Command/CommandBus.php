<?php

declare(strict_types=1);

namespace App\Todo\Application\Bus\Command;

use App\Todo\Application\Bus\Contracts\CommandBusContract;
use Illuminate\Bus\Dispatcher;

class CommandBus implements CommandBusContract
{
    public function __construct(
        protected Dispatcher $bus,
    ) {
    }

    public function dispatch(Command $command): mixed
    {
        return $this->bus->dispatch($command);
    }

    public function register(array $map): void
    {
        $this->bus->map($map);
    }
}
