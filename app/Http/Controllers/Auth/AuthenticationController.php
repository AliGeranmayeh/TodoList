<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Helpers\DB\UserRepository;
use App\Helpers\Responses\RegisterResponse;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $registerIsSuccess = UserRepository::createUser($request->validated());

        return ($registerIsSuccess) ? 
            RegisterResponse::success() :
            RegisterResponse::failed();

    }


    public function login()
    {
    # code...
    }

}
