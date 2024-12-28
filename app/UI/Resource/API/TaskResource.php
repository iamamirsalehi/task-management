<?php

namespace App\UI\Resource\API;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => (string)$this->getId(),
            'title' => (string)$this->getTitle(),
            'description' => (string)$this->getDescription(),
            'deadline' => (string)$this->getDeadline(),
            'board_id' => (string)$this->getBoardID(),
        ];
    }
}
