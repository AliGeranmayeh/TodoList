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
use App\Helpers\Responses\LogoutResponse;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $isRegister = UserRepository::createUser($request->validated());

        return ($isRegister) ? 
            RegisterResponse::success() :
            RegisterResponse::failed();
    }


    public function login(LoginRequest $request)
    {
        $loginResponseStatus = $this->checkLoginCredentials($request->validated());

        return match ($loginResponseStatus) {
                LoginResponseType::SUCCESS => LoginResponse::success(Auth::user()),
                LoginResponseType::VERIFICATION_ERROR => LoginResponse::emailVerificationError(),
                default => LoginResponse::failed(),
            };
    }


    public function logout()
    {
        $isLoggedOut = $this->performeLogout();

        return ($isLoggedOut) ? 
            LogoutResponse::success() :
            LogoutResponse::failed();

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

    private function performeLogout()
    {
        try {
            auth()->user()->tokens()->delete();
        }
        catch (\Throwable $th) {
            return false;
        }
        return true;
    }

}
