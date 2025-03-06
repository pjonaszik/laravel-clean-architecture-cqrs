<?php

declare(strict_types=1);

namespace App\Todo\Presentation\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Validation\Validator;

class DeleteTodoRequest extends TodoRequest
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
        return [
            'title' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'completed' => ['nullable', 'boolean'],
        ];
    }

    public function after(): array
    {
        // Custom validation logic
        // If ID is missing, at least one of the criteria must be provided
        $id = $this->route('id'); // Get {id} from route
        $title = $this->input('title');
        $description = $this->input('description');
        $completed = $this->input('completed');
        return [
            function (Validator $validator) use ($id, $title, $description, $completed) {
                if ((!$id && !$title && !$description && !$completed)) {
                    $validator->errors()->add(
                        'query',
                        'If no ID is provided, at least one of (title, description or completed) must be specified.'
                    );
                }
            }
        ];


    }
}
