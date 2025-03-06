<?php

declare(strict_types=1);

namespace App\Todo\Application\Bus\Contracts;

use App\Todo\Application\Bus\Command\Command;

interface CommandBusContract
{
    public function dispatch(Command $command): mixed;

    public function register(array $map): void;
}
