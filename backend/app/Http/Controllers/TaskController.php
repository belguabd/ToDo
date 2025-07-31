<?php
namespace App\Http\Controllers;

use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(): JsonResponse
    {
        $tasks = $this->taskService->getAllTasksForUser(auth()->id());

        return response()->json([
            'success' => true,
            'tasks' => $tasks
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $task = $this->taskService->getTaskForUser($id, auth()->id());

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'task' => $task
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|in:pending,completed',
            'priority' => 'nullable|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $task = $this->taskService->createTask($request->all(), auth()->id());

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully',
            'task' => $task
        ], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|in:pending,completed',
            'priority' => 'nullable|in:low,medium,high',
            'due_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $task = $this->taskService->updateTask($id, $request->all(), auth()->id());

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully',
            'task' => $task
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->taskService->deleteTask($id, auth()->id());

        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully'
        ]);
    }
}