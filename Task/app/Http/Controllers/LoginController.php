<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Login\ILoginService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function __construct(
        private readonly ILoginService $loginService
    ){}

    public function signIn(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        try {
            $this->loginService->login($request, 'app');
        } catch (\Exception $e) {
            return back()->withErrors(['password' => $e->getMessage()]);
        }


        return Redirect::to('/');
    }

    public function logOut(): RedirectResponse
    {
        Auth::logout();

        return Redirect::to('/sign-in');
    }
}
