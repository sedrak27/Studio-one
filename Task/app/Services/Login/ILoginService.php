<?php

namespace App\Services\Login;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;

interface ILoginService
{
    public function login(LoginRequest $request, string $type): JsonResponse;
}
