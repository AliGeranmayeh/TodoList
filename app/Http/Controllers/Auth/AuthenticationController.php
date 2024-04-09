<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Helpers\DB\UserRepository;
use App\Helpers\Responses\RegisterResponse;
use App\Http\Requests\Auth\LoginRequest;
use App\Helpers\Responses\LoginResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $registerIsSuccess = UserRepository::createUser($request->validated());

        return ($registerIsSuccess) ? 
            RegisterResponse::success() :
            RegisterResponse::failed();
    }


    public function login(LoginRequest $request)
    {
    # code...
    }

}
