<?php

namespace App\UI\Request\API;

use App\Domain\Entity\Board\ID as BoardID;
use App\Domain\Entity\Task\Deadline;
use App\Domain\Entity\Task\Description;
use App\Domain\Entity\Task\Title;
use App\Domain\Entity\User\ID as UserID;
use Illuminate\Foundation\Http\FormRequest;

class AddNewTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'board_id' => ['required', 'numeric', 'exists:boards,id'],
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'description' => ['nullable', 'string', 'max:500'],
            'deadline' => ['nullable', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function getTitle(): Title
    {
        return new Title($this->get('title'));
    }

    public function getBoardID(): BoardID
    {
        return new BoardID($this->get('board_id'));
    }

    public function getUserID(): UserID
    {
        return new UserID($this->get('user_id'));
    }

    public function getDescription(): ?Description
    {
        return $this->has('description') ? new Description($this->get('description')) : null;
    }

    public function getDeadline(): ?Deadline
    {
        return $this->has('deadline') ? new Deadline($this->get('deadline')) : null;
    }
}
