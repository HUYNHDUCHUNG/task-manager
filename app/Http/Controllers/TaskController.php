<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskCollection;
use Illuminate\Http\Request;
use App\Models\Task;
use Spatie\QueryBuilder\QueryBuilder;
class TaskController extends Controller
{
    public function index(Request $request){
        $task = QueryBuilder::for(Task::class)
            ->allowedFilters('is_done')
            ->defaultSort('-created_at')
            ->allowedSorts(['title','is_done','created_at'])
            ->paginate();
        return new TaskCollection($task);
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
