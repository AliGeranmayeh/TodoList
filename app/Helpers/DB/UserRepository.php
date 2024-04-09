<?php


namespace App\Helpers\DB;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\String\ByteString;


class UserRepository
{


    public static function createUser(array $data): bool
    {
        try {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password']
            ]);

            return true;
        }
        catch (\Exception $e) {
            return false;
        }
    }


    public static function findUser(array $data)
    {
        return User::query()
            ->where(function ($query) use ($data) {
            foreach ($data as $key => $value) {
                if ($key != 'password') {
                    $query->where($key, $value);
                }
            }
        })
            ->firstOrFail();

    }

    public static function emailIsVerified($user)
    {
        if ($user->email_verified_at === null) {
            return false;
        }
        return true;
    }
}