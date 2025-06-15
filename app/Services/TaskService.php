<?php
namespace App\Services;
use App\Models\Task;
use App\Enums\TaskStatus;

class TaskService
{
    public function create(array $data): Task
    {
        return auth()->user()->tasks()->create($data);
    }

    public function update(Task $task, array $data): Task
    {
        $task->update($data);
        return $task;
    }

    public function delete(Task $task): void
    {
        $task->delete();
    }
}