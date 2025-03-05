<?php

declare(strict_types=1);

namespace App\Todo\Application\DTOs;

use Illuminate\Foundation\Http\FormRequest;

readonly class RetrieveTodoDTO
{
    public function __construct(
        public string $id,
        public ?string $title,
        public bool $completed = false,
    ) {
    }

    public static function fromRequest(FormRequest $request, string $id): self
    {
        return new self(
            $id,
            $request->validated()['title'] ?? null,
            $request->validated()['completed'] ?? false,
        );
    }
}
