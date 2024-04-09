<?php


namespace App\Helpers\DB;
use App\Models\Task;


class TaskRepository
{
    public static function getUserTasks(int $user_id)
    {
        return Task::query()->orderByDesc('created_at')->get();
    }


    public static function createTask(array $data)
    {
        return Task::create($data);
    }
}