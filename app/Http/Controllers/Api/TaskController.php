<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskResource::collection(task::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $task = Task::create([
            'name'        => $request->name,
            'description' => $request->description,
            'status'      => $request->status,
        ]);
        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::find($id);
        if (! $task) {
            return response()->json([
                'status'  => 404,
                'message' => 'this task not found',
            ]);
        }
        return new TaskResource($task);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, $id)
    {
        $task = Task::find($id);
        if (! $task) {
            return response()->json([
                'status'  => 404,
                'message' => 'this task not found',
            ]);
        }
        $task->update([
            'name'        => $request->name,
            'description' => $request->description,
            'status'      => $request->status,
        ]);
        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if (! $task) {
            return response()->json([
                'status'  => 404,
                'message' => 'this task not found',
            ]);
        }
        $task->delete();
        return response()->json([
            'status'  => 200,
            'message' => 'task deleted successfully',
        ]);
    }
}
