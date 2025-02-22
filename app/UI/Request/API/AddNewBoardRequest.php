<?php

namespace App\UI\Request\API;

use App\Domain\Entity\Board\Description;
use App\Domain\Entity\Board\Name;
use App\Domain\Entity\User\ID as UserID;
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
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'description' => ['nullable', 'string', 'max:200'],
        ];
    }

    public function getName(): Name
    {
        return new Name($this->get('name'));
    }

    public function getUserID(): UserID
    {
        return new UserID($this->get('user_id'));
    }

    public function getDescription(): ?Description
    {
        return $this->has('description') ? new Description($this->get('description')) : null;
    }
}
