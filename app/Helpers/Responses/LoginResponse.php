<?php


namespace App\Helpers\Responses;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;


class LoginResponse
{
    public static function success($user)
    {
        return response()->json([
            'access_token' => $user->createToken('API Token')->plainTextToken],
            Response::HTTP_OK);
    }

    public static function failed()
    {
        return response()->json(['message' => 'Invalid Credentials'], Response::HTTP_UNAUTHORIZED);
    }


    public static function emailVerificationError()
    {
        return response()->json(['message' => 'Email is not verified'], Response::HTTP_FORBIDDEN);
    }
}