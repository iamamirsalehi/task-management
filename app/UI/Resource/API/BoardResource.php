<?php

namespace App\UI\Resource\API;

use App\Domain\Entity\Board\Board;
use Illuminate\Http\Resources\Json\JsonResource;

class BoardResource extends JsonResource
{
    public function toArray($request): array
    {
        /** @var $this Board */
        return [
            'name' => (string)$this->getName(),
            'description' => (string)$this->getDescription(),
        ];
    }
}
