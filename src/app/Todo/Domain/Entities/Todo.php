<?php

declare(strict_types=1);

namespace App\Todo\Domain\Entities;

readonly class Todo
{
    public function __construct(
        public ?string            $id,
        public string             $title,
        public string             $description,
        public \DateTimeImmutable $dueDate,
        public bool               $completed = false,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'dueDate' => $this->dueDate->format(\DateTimeInterface::RFC3339),
            'completed' => $this->completed,
        ];
    }
}
