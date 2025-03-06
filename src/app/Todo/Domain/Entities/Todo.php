<?php

declare(strict_types=1);

namespace App\Todo\Domain\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

readonly class Todo
{
    public function __construct(
        public ?string $id,
        public string $title,
        public string $description,
        public \DateTimeImmutable $dueDate,
        public bool $completed = false,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->dueDate->format(\DateTimeInterface::RFC3339),
            'completed' => $this->completed,
        ];
    }

    public static function fromModel(Model $model): self
    {
        return new self(
            id: $model->id,
            title: $model->title,
            description: $model->description,
            dueDate: Carbon::parse($model->due_date)->toDateTimeImmutable(),
            completed: $model->completed
        );
    }
}
