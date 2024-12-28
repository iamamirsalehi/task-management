<?php

namespace App\UI\Request\API;

use Illuminate\Foundation\Http\FormRequest;

class AddNewBoardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'description' => ['nullable', 'string', 'max:200'],
            'user_id' => ['nullable', 'integer'],
        ];
    }
}
