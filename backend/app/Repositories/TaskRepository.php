<?php
namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;

class TaskRepository
{
    protected Task $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function getAllForUser(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function findByIdForUser(int $id, int $userId): ?Task
    {
        return $this->model->where('id', $id)
            ->where('user_id', $userId)
            ->first();
    }

    public function create(array $data): Task
    {
        return $this->model->create($data);
    }

    public function update(Task $task, array $data): bool
    {
        return $task->update($data);
    }

    public function delete(Task $task): bool
    {
        return $task->delete();
    }
}