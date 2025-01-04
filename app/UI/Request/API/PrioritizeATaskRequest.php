<?php

namespace App\UI\Request\API;

use App\Domain\Entity\Enums\TaskPriority;
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

    private function getPriorityAsString(): string
    {
        $priorities = '';
        foreach (TaskPriority::cases() as $priority) {
            $priorities .= $priority->value . ', ';
        }

        return rtrim($priorities, ', ');
    }
}
