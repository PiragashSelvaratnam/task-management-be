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
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "status" => $this->status,
            "priority" => $this->priority,
            "due_date" => $this->due_date,
            "created_by" => [
                "id" => $this->createdBy?->id,
                "name" => $this->createdBy?->name,
                'email' => $this->createdBy?->email,
            ],
            "assigned_to" => [
                "id" => $this->assignedTo?->id,
                "name" => $this->assignedTo?->name,
                'email' => $this->assignedTo?->email,
            ],
        ];
    }
}
