<?php

namespace App\UI\Request\API;

use Illuminate\Foundation\Http\FormRequest;

class AssignDeadlineToATaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'deadline' => ['required', 'date', 'after_or_equal:today'],
        ];
    }
}
