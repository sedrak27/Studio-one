<?php

namespace App\Services\Register;

use Illuminate\Http\JsonResponse;

interface IRegisterService
{
    public function register(array $data): JsonResponse;
}
