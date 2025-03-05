<?php

declare(strict_types=1);

namespace App\Todo\Application\Commands;

readonly class CreateTodoCommand
{
    public function __construct(
        public string $title,
        public string $description,
        public string $dueDate,
        public bool $completed,)
    {
    }
}
