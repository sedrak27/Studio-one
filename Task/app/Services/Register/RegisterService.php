<?php

namespace App\Services\Register;

use App\Repositories\Register\IRegisterRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegisterService implements IRegisterService
{
    public function __construct(
        private readonly IRegisterRepository $registerRepository
    ){}

    public function register(array $data): JsonResponse
    {
        $data['password'] = Hash::make($data['password']);

        $this->registerRepository->register($data);

        return response()->json([
            'message' => 'Registered successfully',
            'data' => [],
        ]);
    }
}
