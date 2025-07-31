<?php
namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Events\TaskCreated;
use Illuminate\Database\Eloquent\Collection;

class TaskService
{
    protected TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTasksForUser(int $userId): Collection
    {
        return $this->taskRepository->getAllForUser($userId);
    }

    public function getTaskForUser(int $id, int $userId): ?Task
    {
        return $this->taskRepository->findByIdForUser($id, $userId);
    }

    public function createTask(array $data, int $userId): Task
    {
        $data['user_id'] = $userId;
        $task = $this->taskRepository->create($data);
        
        // Broadcast event for real-time notifications
        event(new TaskCreated($task));
        
        return $task;
    }

    public function updateTask(int $id, array $data, int $userId): ?Task
    {
        $task = $this->getTaskForUser($id, $userId);
        
        if (!$task) {
            return null;
        }

        $this->taskRepository->update($task, $data);
        return $task->fresh();
    }

    public function deleteTask(int $id, int $userId): bool
    {
        $task = $this->getTaskForUser($id, $userId);
        
        if (!$task) {
            return false;
        }

        return $this->taskRepository->delete($task);
    }
}