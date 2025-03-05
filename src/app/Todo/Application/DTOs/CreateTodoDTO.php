<?php

declare(strict_types=1);

namespace App\Todo\Application\DTOs;

use Illuminate\Foundation\Http\FormRequest;

readonly class CreateTodoDTO
{
    public function __construct(
        public string $title,
        public string $description,
        public string $dueDate,
        public bool   $completed = false,
    ) {
    }

    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            $request->validated()['title'],
            $request->validated()['description'],
            $request->validated()['due_date'],
        );
    }
}
