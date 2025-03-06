<?php

declare(strict_types=1);

namespace App\Todo\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class TodoRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    protected function prepareForValidation(): void
    {
        $this->merge([
//            'title' => Str::title($this->input('title')),
        ]);
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
//            'due_date.after' => 'Due date time must be at least 5min after now.',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'due_date' => 'Due date',
        ];
    }
}
