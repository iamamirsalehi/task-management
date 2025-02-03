<?php

namespace App\UI\Request\API;

use Illuminate\Foundation\Http\FormRequest;

class GetTasksRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'numeric', 'exists:users,id'],
        ];
    }
}
