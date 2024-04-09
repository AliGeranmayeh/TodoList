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
use App\Enums\LoginResponseType;

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
        $loginIsSuccess = $this->checkLoginCredentials($request->validated());

        return match ($loginIsSuccess) {
                LoginResponseType::SUCCESS => LoginResponse::success(Auth::user()),
                LoginResponseType::VERIFICATION_ERROR => LoginResponse::emailVerificationError(),
                default => LoginResponse::failed(),
            };

    }


    public function logout()
    {
        # code...
    }

    private function checkLoginCredentials(array $loginData)
    {
        try {
            $user = UserRepository::findUser($loginData);
        }
        catch (\Throwable $th) {
            return LoginResponseType::FAILED;
        }

        if (!UserRepository::emailIsVerified($user)) {
            return LoginResponseType::VERIFICATION_ERROR;
        }

        return Auth::attempt($loginData) ? 
            LoginResponseType::SUCCESS :
            LoginResponseType::FAILED;

    }

}
