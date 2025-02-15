<?php

namespace App\UI\Request\API;

use App\Domain\Enum\TaskPriority;
use App\Domain\Enum\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;

class FilterTasksRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'priority' => ['nullable', 'string', 'in:' . $this->getPriorities() . ''],
            'status' => ['nullable', 'string', 'in:' . $this->getStatuses() . ''],
        ];
    }

    private function getPriorities(): string
    {
        return implode(',', TaskPriority::getValuesAsArray());
    }

    private function getStatuses(): string
    {
        return implode(',', TaskStatus::getValuesAsArray());
    }
}
