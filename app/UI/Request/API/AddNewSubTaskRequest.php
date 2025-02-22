<?php

namespace App\UI\Request\API;

use App\Domain\Entity\SubTask\Description;
use App\Domain\Entity\SubTask\Title;
use App\Domain\Entity\Task\ID as TaskID;
use App\Domain\Entity\User\ID as UserID;
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
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'task_id' => ['required', 'numeric', 'exists:tasks,id'],
            'description' => ['nullable', 'min:3', 'max:500'],
        ];
    }

    public function getTitle(): Title
    {
        return new Title($this->get('title'));
    }

    public function getDescription(): ?Description
    {
        return $this->has('description') ? new Description($this->get('description')) : null;
    }

    public function getUserID(): UserID
    {
        return new UserID($this->get('user_id'));
    }

    public function getTaskID(): TaskID
    {
        return new TaskID($this->get('task_id'));
    }
}
