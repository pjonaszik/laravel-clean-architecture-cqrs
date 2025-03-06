<?php

declare(strict_types=1);

namespace App\Todo\Presentation\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class RetrieveTodoRequest extends TodoRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
        return [
            'id' => ['ulid'],
            'title' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
            'completed' => ['nullable', 'boolean'],
        ];
    }
}
