<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\Register\IRegisterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function __construct(
        private readonly IRegisterService $registerService
    ){}

    public function signUp()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $this->registerService->register($request->validated());

        return Redirect::to('/sign-in');
    }
}
