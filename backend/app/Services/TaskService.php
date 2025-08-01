<?php
// app/Services/TaskService.php
namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Events\TaskCreated;
use App\Events\TaskUpdated;
use App\Events\TaskDeleted;
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
        
        broadcast(new TaskCreated($task));
        return $task;
    }

    public function updateTask(int $id, array $data, int $userId): ?Task
    {
        $task = $this->getTaskForUser($id, $userId);
        
        if (!$task) {
            return null;
        }

        $this->taskRepository->update($task, $data);
        $updatedTask = $task->fresh();
        
        return $updatedTask;
    }

    public function deleteTask(int $id, int $userId): bool
    {
        $task = $this->getTaskForUser($id, $userId);
        
        if (!$task) {
            return false;
        }

        $taskTitle = $task->title;
        $deleted = $this->taskRepository->delete($task);    
        return $deleted;
    }
}