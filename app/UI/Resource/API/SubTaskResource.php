<?php

namespace App\UI\Resource\API;

use App\Domain\Entity\SubTask\SubTask;
use Illuminate\Http\Resources\Json\JsonResource;

class SubTaskResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var $this SubTask */
        return [
            'id' => (string)$this->getId(),
            'title' => (string)$this->getDescription(),
            'description' => (string)$this->getDescription(),
            'status' => $this->getStatus()->value,
            'parent_id' => (string)$this->getParentId(),
            'created_at' => $this->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at' => $this->getUpdatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}
