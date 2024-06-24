<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnimalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'age' => $this->age,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'description' => $this->description,
            'state' => $this->state,
            'pictures' => $this->pictures,
            'price' => $this->price,

        ];
    }
}
