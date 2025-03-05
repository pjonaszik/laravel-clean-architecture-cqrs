<?php

declare(strict_types=1);

namespace App\Todo\Application\DTOs;

use Illuminate\Foundation\Http\FormRequest;

readonly class RetrieveAllTodoDTO
{
    public function __construct(
        public bool $completed = false,
    ) {
    }

    public static function fromRequest(FormRequest $request): self
    {
        return new self(
            $request->validated()['completed'] ?? false,
        );
    }
}
