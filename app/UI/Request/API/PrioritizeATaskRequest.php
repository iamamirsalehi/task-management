<?php

namespace App\UI\Request\API;

use App\Domain\Enum\TaskPriority;
use Illuminate\Foundation\Http\FormRequest;

class PrioritizeATaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'priority' => ['required', 'string', 'in:' . $this->getPriorityAsString() . '']
        ];
    }

    public function getPriority(): TaskPriority
    {
        return TaskPriority::from($this->get('priority'));
    }

    private function getPriorityAsString(): string
    {
        return implode(',', TaskPriority::getValuesAsArray());
    }
}
