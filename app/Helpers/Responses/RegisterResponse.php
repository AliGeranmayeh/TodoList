<?php 

namespace App\Helpers\Responses;
use Symfony\Component\HttpFoundation\Response;


class RegisterResponse{
    public static function success()
    {
        return response()->json(['message' => 'User created successfully'], Response::HTTP_OK);
    }

    public static function failed()
    {
        return response()->json(['message' => 'Failed to create user'], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}