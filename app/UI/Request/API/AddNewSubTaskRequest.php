<?php

namespace App\UI\Request\API;

use Illuminate\Foundation\Http\FormRequest;

class AddNewSubTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3', 'max:100'],
            'description' => ['required', 'min:3', 'max:500'],
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'task_id' => ['nullable', 'numeric', 'exists:tasks,id'],
        ];
    }
}
