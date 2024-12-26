<?php

namespace App\UI\Resource\API;

use Illuminate\Http\Resources\Json\JsonResource;

class BoardResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'name' => (string)$this->getName(),
            'description' => (string)$this->getDescription(),
        ];
    }
}
