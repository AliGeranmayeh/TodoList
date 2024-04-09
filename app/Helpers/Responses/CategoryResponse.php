<?php 

namespace App\Helpers\Responses;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CategoryResource;


class CategoryResponse{
    public static function failed()
    {
        return response()->json(['message' => 'Failed to fetch categories'], Response::HTTP_SERVICE_UNAVAILABLE);
    }

    public static function indexSuccess($tasks)
    {
        return response()->json(['tasks' => CategoryResource::collection($tasks)], Response::HTTP_OK);
    }
}