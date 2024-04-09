<?php 

namespace App\Helpers\Responses;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\TaskResource;


class TaskResponse {


    public static function failed()
    {
        return response()->json(['message' => 'Failed to fetch tasks'], Response::HTTP_SERVICE_UNAVAILABLE);
    }

    public static function indexSuccess($tasks)
    {
        return response()->json(['tasks' => TaskResource::collection($tasks)], Response::HTTP_OK);

    }

    public static function createSuccess($task)
    {
        return response()->json(['task' => new TaskResource($task)], Response::HTTP_OK);

    }
}