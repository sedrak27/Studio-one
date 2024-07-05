<?php

namespace App\Services\Login;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class LoginService implements ILoginService
{
    public function login(LoginRequest $request, string $type): JsonResponse
    {
        $data = $request->validated();

        $key = $request->ip() . '/' . $data['email'];

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);

            throw new \Exception("You may try again in $seconds seconds.");
        }

        RateLimiter::hit($key);

        $responseData = [];

        if (Auth::validate($data)) {
            Auth::attempt($data);

            Auth::user()->update(['last_login_at' => now()]);
        } else {
            throw new \Exception('Invalid credentials');
        }

        return response()->json($responseData);
    }
}
