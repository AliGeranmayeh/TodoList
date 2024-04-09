<?php


namespace App\Helpers\DB;
use App\Models\Task;


class TaskRepository
{
    public static function getTasks()
    {
        return Task::query()->orderByDesc('created_at')->get();
    }


    public static function createTask(array $data)
    {
        return Task::create($data);
    }

    public static function updateTask(Task $task, array $data)
    {
        return $task->update($data);
    }
}