<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskCollection;
use Illuminate\Http\Request;
use App\Models\Task;
class TaskController extends Controller
{
    public function index(Request $request){
        return new TaskCollection(Task::all());
    }

    public function show(Request $request,Task $task){
        return new TaskResource($task);
    }

    public function store(StoreTaskRequest $request)
    {
        $validate = $request->validated();
        $task = Task::create($validate);
        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request,Task $task)
    {
        $validate = $request->validated();
        $task->update($validate);
        return new TaskResource($task);

    }

    public function destroy(Request $request,Task $task)
    {
        $task->delete();
        return response()->noContent();
    }

}
