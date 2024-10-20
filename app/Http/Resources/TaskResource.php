<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'due_date' => $this->due_date,
            'priority' => $this->priority, // Додано пріоритет завдання
            'completed_at' => $this->completed_at, // Дата та час завершення
            'project' => new ProjectResource($this->project),
            'responsible' => new UserResource($this->assignedUser),
            'created_by' => new UserResource($this->createdBy), // Додав користувача, який створив завдання
            'updated_by' => new UserResource($this->updatedBy), // Додав користувача, який останнім редагував завдання
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
