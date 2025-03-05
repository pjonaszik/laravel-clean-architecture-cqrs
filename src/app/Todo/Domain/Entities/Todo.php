<?php

declare(strict_types=1);

namespace App\Todo\Domain\Entities;

use App\Todo\Domain\ValueObjects\TaskDescription;
use App\Todo\Domain\ValueObjects\TaskDueDate;
use App\Todo\Domain\ValueObjects\TaskTitle;

readonly class Todo
{
    public function __construct(
        public ?string $id,
        public TaskTitle $title,
        public TaskDescription $description,
        public TaskDueDate $dueDate,
        public bool $completed = false,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title->value,
            'description' => $this->description->value,
            'dueDate' => $this->dueDate->value->format(\DateTimeInterface::RFC3339),
            'completed' => $this->completed,
        ];
    }
}
