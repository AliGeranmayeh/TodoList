<?php


namespace App\Helpers\DB;
use App\Models\Task;


class TaskRepository
{
    public static function getUserTasks(int $user_id)
    {
        return Task::query()->where('user_id',$user_id)->orderByDesc('created_at')->get();
    }
}