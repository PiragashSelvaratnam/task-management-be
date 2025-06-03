<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignTaskRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskStatusRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Console\View\TaskResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class TaskController extends Controller
{
    public function index()
    {
        
    $tasks = QueryBuilder::for(Task::class)
    ->allowedFilters(['title', 'status'])
    ->get();
        return response()->json(['data' => TaskResource::collection(resource:$tasks)], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request){
        $data = $request->validated();
        $data['assigned_to'] = Auth::id();;
        $data["created_by"] = Auth::id();;
        $task = Task::create($data);
        return response()->json(['data' => new TaskResource($task)], 201);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json(['data' => new TaskResource($task)], 200);
    }

    public function update(TaskRequest $request, $id)
    {
        $data = $request->validated();
        $task = Task::findOrFail($id);
        $task->update($data);
        return response()->json(['data' => new TaskResource($task)], 200);
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function updateStatus(TaskStatusRequest $request, Task $task)
    {
        $data = $request->validated();
        $task = Task::findOrFail($task->id);
        $task->update(['status' => $data['status']]);
        return response()->json(['Status update successfully!.'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function assignTask(AssignTaskRequest $request, Task $task)
    {
        $data = $request->validated();
        $assignUser = User::where("is_admin", false)->where("id", $data['id'])
            ->first();

        if (!$assignUser) {
            return response()->json(['message' => 'User not found or inactive.'], 404);
        }

        $task->assignedTo()->associate($assignUser);

        return response()->json([
            'message' => 'Task assigned successfully.',
            'data' => new TaskResource($task)
        ], 200);
    }
}
