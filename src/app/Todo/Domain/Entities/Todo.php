<?php

declare(strict_types=1);

namespace App\Todo\Domain\Entities;

use App\Todo\Domain\ValueObjects\DueDate;
use App\Todo\Domain\ValueObjects\TaskDescription;
use App\Todo\Domain\ValueObjects\TaskTitle;
use DateTimeInterface;

class Todo
{
    public function __construct(
        public ?string $id {
            get => $this->id;
        },
        public TaskTitle $title {
            get => $this->title;
        },
        public TaskDescription $description {
            get => $this->description;
        },
        public DueDate $dueDate {
            get => $this->dueDate;
        },
        public bool $completed = false {
            get => $this->completed;
        set => (bool) $value;
        },
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title->value,
            'description' => $this->description->value,
            'dueDate' => $this->dueDate->value,
            'completed' => $this->completed,
        ];
    }
}
