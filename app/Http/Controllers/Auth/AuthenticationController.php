<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Helpers\DB\UserRepository;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $registerIsSuccess = UserRepository::createUser($request->validated());

        if ($registerIsSuccess) {
            return response()->json(['message' => 'User created successfully'], 200);
        }
        return response()->json(['message' => 'Failed to create user'], 500);

    }


    public function login()
    {
    # code...
    }

}
