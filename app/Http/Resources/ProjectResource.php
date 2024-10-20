<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'budget' => $this->budget, // Додаємо бюджет
            'created_by' => $this->created_by, // Користувач, який створив проект
            'updated_by' => $this->updated_by, // Користувач, який останнім редагував проект
            'notes' => $this->notes, // Додаткові нотатки
            'tags' => $this->tags, // Теги
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
