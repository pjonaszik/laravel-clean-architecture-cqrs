<?php

declare(strict_types=1);

namespace App\Todo\Application\Commands;

use App\Todo\Application\Bus\Command\Command;
use App\Todo\Application\Data\CreateTodoData;

readonly class CreateTodoCommand extends Command
{
    public function __construct(
        public CreateTodoData $createTodoData,
    ) {
    }
}
