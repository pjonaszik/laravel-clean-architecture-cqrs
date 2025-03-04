<?php

declare(strict_types=1);

namespace App\Todo\Application\Requests;

use Illuminate\Contracts\Validation\ValidationRule;

class CreateRequest extends TodoRequest
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
            'title' => ['string'],
            'description' => ['string'],
            'due_date' => ['date'],
        ];
    }
}
