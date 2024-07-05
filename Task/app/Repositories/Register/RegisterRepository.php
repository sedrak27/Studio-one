<?php

namespace App\Repositories\Register;

use App\Models\User;

class RegisterRepository implements IRegisterRepository
{
    public function register(array $data): User
    {
        $user = new User($data);
        $user->save();

        return $user;
    }
}
