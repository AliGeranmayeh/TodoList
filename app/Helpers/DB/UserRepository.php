<?php


namespace App\Helpers\DB;
use App\Models\User;


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
}