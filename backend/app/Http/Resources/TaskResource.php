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
            'completed' => $this->status === 'completed',
            'priority' => $this->priority,
            'due_date' => $this->due_date?->format('Y-m-d'), 
            'tags' => $this->tags ?? [],
            'user_id' => $this->user_id,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
            
            // Optional: Add computed fields
            'is_overdue' => $this->due_date && $this->due_date->isPast() && $this->status !== 'completed',
            'days_until_due' => $this->due_date ? now()->diffInDays($this->due_date, false) : null,
            
            // Optional: Add user relationship if needed
            'user' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                ];
            }),
        ];
    }
}