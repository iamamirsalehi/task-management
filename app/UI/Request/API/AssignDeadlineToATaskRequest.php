<?php

namespace App\UI\Request\API;

use App\Domain\Entity\Task\Deadline;
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

    public function getDeadline(): Deadline
    {
        return new Deadline($this->get('deadline'));
    }
}
