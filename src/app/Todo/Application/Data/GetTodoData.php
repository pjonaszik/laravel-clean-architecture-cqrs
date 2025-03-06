<?php

declare(strict_types=1);

namespace App\Todo\Application\Data;

use App\Todo\Domain\ValueObjects\TaskTitle;
use App\Todo\Presentation\Requests\RetrieveTodoRequest;

readonly class GetTodoData
{
    public function __construct(
        public string       $id,
        public ?TaskTitle   $title = null,
        public bool        $completed = false,
    ) {
    }

    public static function fromRequest(RetrieveTodoRequest $request): self
    {
        return new self(
            id: $request->validated()['id'],
            title: isset($request->validated()['title'])
                ? TaskTitle::fromValue($request->validated()['title'])
                : null,
            completed: $request->validated()['completed'] ?? false,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title?->value,
            'completed' => $this->completed,
        ];
    }
}
