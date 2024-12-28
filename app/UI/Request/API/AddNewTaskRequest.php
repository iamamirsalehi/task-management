<?php

namespace App\UI\Request\API;

use Illuminate\Foundation\Http\FormRequest;

class AddNewTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'description' => ['nullable', 'string', 'max:500'],
            'board_id' => ['required', 'numeric'],
            'deadline' => ['nullable', 'date'],
            'user_id' => ['required', 'numeric'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}