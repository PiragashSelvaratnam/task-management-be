<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Console\View\TaskResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = \App\Models\Task::query()->get();
        return response()->json(['data' => TaskResource::collection($tasks)], 200);
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
    public function updateStatus()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function assignTask(Request $request)
    {
        //
    }
}
