<?php

declare(strict_types=1);

namespace App\Todo\Application\Data;

use App\Todo\Domain\ValueObjects\TaskTitle;
use App\Todo\Presentation\Requests\RetrieveAllTodoRequest;

readonly class RetrieveAllTodoData
{
    public function __construct(
        public ?TaskTitle   $title = null,
        public ?bool        $completed = false,
    ) {
    }

    public static function fromRequest(RetrieveAllTodoRequest $request): self
    {
        return new self(
            title: isset($request->validated()['title'])
                ? TaskTitle::fromValue($request->validated()['title'])
                : null,
            completed: $request->validated()['completed'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title?->value,
            'completed' => $this->completed,
        ];
    }
}
