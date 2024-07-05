<?php

namespace App\Repositories\Register;

use App\Models\User;

interface IRegisterRepository
{
    public function register(array $data): User;
}
