<?php


namespace App\Helpers\DB;
use App\Models\Task;


class TaskRepository
{
    public static function getTasks()
    {
        return Task::query()->with('categories')->orderByDesc('created_at')->get();
    }


    public static function createTask(array $data)
    {
        $task = Task::create($data);
        static::addCategories($task, $data['categories'] ?? []);

        return $task;

    }

    public static function updateTask(Task $task, array $data)
    {
        $task->update($data);
        static::reAttachCategories($task, $data['categories'] ?? []);
    }

    private static function addCategories(Task $task, array $data)
    {
        $task->categories()->sync($data);
    }

    private static function reAttachCategories(Task $task, array $data)
    {
        $task->categories()->detach();
        $task->categories()->sync($data);
    }
}