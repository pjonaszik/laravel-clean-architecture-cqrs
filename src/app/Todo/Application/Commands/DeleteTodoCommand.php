<?php

declare(strict_types=1);

namespace App\Todo\Application\Commands;

use App\Todo\Application\Bus\Command\Command;

readonly class DeleteTodoCommand extends Command
{
    public function __construct(
        public string $id,
    ) {
    }
}
