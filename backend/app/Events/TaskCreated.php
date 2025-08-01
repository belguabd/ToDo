<?php
// app/Events/TaskCreated.php

namespace App\Events;

use App\Models\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TaskCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task;
    public $user;

    public function __construct(Task $task)
    {
        $this->task = $task;
        $this->user = $task->user; // Assuming task belongs to user
    }

    /**
     * Get the channels the event should broadcast on.
     */
    public function broadcastOn()
    {
        return [
            // Public channel - all users can see new tasks
            new Channel('tasks'),
            
            // Private channel - only the user who created the task
            new PrivateChannel('user.' . $this->user->id),
            
            // You can also broadcast to a team/workspace channel
            // new PrivateChannel('team.' . $this->task->team_id),
        ];
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs()
    {
        return 'task.created';
    }

    /**
     * Get the data to broadcast.
     */
    public function broadcastWith()
    {
        return [
            'task' => [
                'id' => $this->task->id,
                'title' => $this->task->title,
                'description' => $this->task->description,
                'status' => $this->task->status,
                'priority' => $this->task->priority,
                'due_date' => $this->task->due_date,
                'created_at' => $this->task->created_at->toISOString(),
                'updated_at' => $this->task->updated_at->toISOString(),
            ],
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],
            'message' => "New task '{$this->task->title}' has been created!",
            'timestamp' => now()->toISOString(),
        ];
    }
}