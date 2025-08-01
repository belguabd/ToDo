<?php
namespace App\Http\Controllers;

use App\Services\TaskService;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Events\TaskCreated;

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
            'tasks' => TaskResource::collection($tasks)
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
            'task' => new TaskResource($task)
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
            'completed' => 'nullable|boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        
        // Handle completed field from frontend
        if ($request->has('completed')) {
            $data['status'] = $request->boolean('completed') ? 'completed' : 'pending';
        }

        $task = $this->taskService->createTask($data, auth()->id());
        
        
        
        return response()->json([
            'success' => true,
            'message' => 'Task created successfully',
            'task' => new TaskResource($task)
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
            'completed' => 'nullable|boolean',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:50'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        
        // Handle completed field from frontend
        if ($request->has('completed')) {
            $data['status'] = $request->boolean('completed') ? 'completed' : 'pending';
        }

        $task = $this->taskService->updateTask($id, $data, auth()->id());

        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully',
            'task' => new TaskResource($task)
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