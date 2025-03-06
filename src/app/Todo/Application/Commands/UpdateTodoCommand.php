<?php

declare(strict_types=1);

namespace App\Todo\Application\Commands;

use App\Todo\Application\Bus\Command\Command;
use App\Todo\Application\Data\CreateTodoData;
use App\Todo\Application\Data\UpdateTodoData;

readonly class UpdateTodoCommand extends Command
{
    public function __construct(
        public UpdateTodoData $updateTodoData,
    ) {
    }
}
