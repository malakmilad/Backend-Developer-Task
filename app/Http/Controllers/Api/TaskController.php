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
        return response()->json([
            'status'  => 200,
            'message' => 'Task Retrieved Successfully',
            'data'    => TaskResource::collection(Task::paginate(10)),
        ], 200);
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
        return response()->json([
            'status'  => 200,
            'message' => 'Task Created Successfully',
            'data'    => new TaskResource($task),
        ], 200);
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
                'message' => 'This Task Not Found',
            ], 404);
        }
        return response()->json([
            'status'  => 200,
            'message' => 'Task Retrieved Successfully',
            'data'    => new TaskResource($task),
        ], 200);
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
                'message' => 'This Task Not Found',
            ], 404);
        }
        $task->update([
            'name'        => $request->name,
            'description' => $request->description,
            'status'      => $request->status,
        ]);
        return response()->json([
            'status'  => 200,
            'message' => 'Task Updated Successfully',
            'data'    => new TaskResource($task),
        ], 200);
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
                'message' => 'This Task Not Found',
            ], 404);
        }
        $task->delete();
        return response()->json([
            'status'  => 200,
            'message' => 'Task Deleted Successfully',
        ], 200);
    }
    public function filter(Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed',
        ], [
            'status.required' => 'The status field is required.',
            'status.in' => 'Invalid status. Allowed values: pending, in_progress, completed.',
        ]);

        $query = Task::query();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        return response()->json([
            'status'  => 200,
            'message' => 'Task Retrieved Successfully',
            'data'    => TaskResource::collection($query->paginate(10)),
        ], 200);
    }
}
