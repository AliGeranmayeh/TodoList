<?php


namespace App\Helpers\Responses;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\CategoryResource;


class CategoryResponse
{
    public static function failed()
    {
        return response()->json(['message' => 'Failed to fetch categories'], Response::HTTP_SERVICE_UNAVAILABLE);
    }

    public static function indexSuccess($categories)
    {
        return response()->json(['categories' => CategoryResource::collection($categories)], Response::HTTP_OK);
    }

    public static function createSuccess($category)
    {
        return response()->json(['category' => new CategoryResource($category)], Response::HTTP_OK);
    }

    public static function destroySuccess()
    {
        return response()->json(['message' => 'Category has been deleted'], Response::HTTP_OK);
    }
}