<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;

use Illuminate\Routing\Controller;
use App\Services\AuthService;
use App\Constants\AuthMessages;
use App\Helpers\ResponseHelper;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, AuthService $authService)
    {
        $data = $authService->register($request->validated());

        return ResponseHelper::success(
            AuthMessages::REGISTER_SUCCESS,
            [
                'user' => new UserResource($data['user']),
                'token' => $data['token'],
            ],
            201
        );
    }

    public function login(LoginRequest $request, AuthService $authService)
    {
        $data = $authService->login($request->only('email', 'password'));

        return ResponseHelper::success(
            AuthMessages::LOGIN_SUCCESS,
            [
                'user' => new UserResource($data['user']),
                'token' => $data['token'],
            ]
        );
    }

    public function logout(Request $request, AuthService $authService)
    {
        $authService->logout(auth()->user());
        return ResponseHelper::success(AuthMessages::LOGOUT_SUCCESS);
    }
}
