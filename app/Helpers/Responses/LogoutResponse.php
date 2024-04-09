<?php


namespace App\Helpers\Responses;
use Symfony\Component\HttpFoundation\Response;


class LogoutResponse
{
    public static function success()
    {
        return response()->json(['message' => 'You have been successfully logged out'], Response::HTTP_OK);
    }

    public static function failed()
    {
        return response()->json(['message' => 'Failed to logout user'], Response::HTTP_BAD_REQUEST);
    }
}