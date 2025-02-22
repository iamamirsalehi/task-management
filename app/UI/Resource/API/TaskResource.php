<?php

namespace App\UI\Resource\API;

use App\Domain\Entity\Task\Task;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var Task $this */
        return [
            'id' => (string)$this->getId(),
            'title' => (string)$this->getTitle(),
            'description' => (string)$this->getDescription(),
            'deadline' => (string)$this->getDeadline(),
            'board_id' => (string)$this->getBoardID(),
            'created_at' => $this->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $this->getUpdatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}
