<?php

namespace App\Http\Controllers;

use App\Constants\TaskMessages;
use App\Http\Requests\TaskRequest;
use App\Helpers\ResponseHelper;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class TaskController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $tasks = TaskResource::collection(auth()->user()->tasks);
        return ResponseHelper::success(TaskMessages::FETCH_SUCCESS, $tasks);
    }

    public function store(TaskRequest $request, TaskService $service)
    {
        $task = $service->create($request->validated());
        return ResponseHelper::success(TaskMessages::CREATE_SUCCESS, new TaskResource($task), 201);
    }

    public function show(Task $task)
    {
        $this->authorize("view", $task);
        return ResponseHelper::success(TaskMessages::SHOW_SUCCESS, new TaskResource($task));
    }

    public function update(TaskRequest $request, Task $task, TaskService $service)
    {
        $this->authorize("update", $task);
        $task = $service->update($task, $request->validated());
        return ResponseHelper::success(TaskMessages::UPDATE_SUCCESS, new TaskResource($task));
    }

    public function destroy(Task $task, TaskService $service)
    {
        $this->authorize("delete", $task);
        $service->delete($task);
        return ResponseHelper::success(TaskMessages::DELETE_SUCCESS);
    }
}
