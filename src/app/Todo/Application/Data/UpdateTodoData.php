<?php

declare(strict_types=1);

namespace App\Todo\Application\Data;

use App\Todo\Domain\ValueObjects\TaskDescription;
use App\Todo\Domain\ValueObjects\TaskDueDate;
use App\Todo\Domain\ValueObjects\TaskTitle;
use App\Todo\Presentation\Requests\UpdateTodoRequest;

readonly class UpdateTodoData
{
    public function __construct(
        public string       $id,
        public ?TaskTitle   $title = null,
        public ?TaskDescription   $description = null,
        public ?TaskDueDate   $dueDate = null,
        public bool        $completed = false,
    ) {
    }

    public static function fromRequest(UpdateTodoRequest $request, string $id): self
    {
        return new self(
            id: $id,
            title: isset($request->validated()['title'])
                ? TaskTitle::fromValue($request->validated()['title'])
                : null,
            description: isset($request->validated()['description'])
                ? TaskDescription::fromValue($request->validated()['description'])
                : null,
            dueDate: isset($request->validated()['due_date'])
                ? TaskDueDate::fromValue($request->validated()['due_date'])
                : null,
            completed: $request->validated()['completed'] ?? false,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title?->value,
            'description' => $this->description?->value,
            'due_date' => $this->dueDate?->value->format(\DateTimeInterface::RFC3339),
            'completed' => $this->completed,
        ];
    }
}
