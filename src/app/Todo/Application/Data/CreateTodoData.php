<?php

declare(strict_types=1);

namespace App\Todo\Application\Data;

use App\Todo\Domain\ValueObjects\TaskDescription;
use App\Todo\Domain\ValueObjects\TaskDueDate;
use App\Todo\Domain\ValueObjects\TaskTitle;
use App\Todo\Presentation\Requests\CreateTodoRequest;

class CreateTodoData
{
    public function __construct(
        public ?string $id,
        public TaskTitle $title,
        public TaskDescription $description,
        public TaskDueDate $dueDate,
        public ?bool $completed,
    ) {
    }

    public static function fromRequest(CreateTodoRequest $request): self
    {
        return new self(
            id: null,
            title: TaskTitle::fromValue($request->validated()['title']),
            description: TaskDescription::fromValue($request->validated()['description']),
            dueDate: TaskDueDate::fromValue($request->validated()['due_date']),
            completed: $request->validated()['completed'] ?? false,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title->value,
            'description' => $this->description->value,
            'due_date' => $this->dueDate->value->format(\DateTimeInterface::RFC3339),
            'completed' => $this->completed,
        ];
    }
}
