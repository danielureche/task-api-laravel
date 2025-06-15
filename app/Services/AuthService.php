<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\InvalidCredentialsException;

class AuthService
{
    public function register(array $data): array
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'email_verified_at' => now(),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        return compact('user', 'token');
    }

    public function login(array $credentials): array|null
    {
        if (!Auth::attempt($credentials)) {
            throw new InvalidCredentialsException();
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return compact('user', 'token');
    }

    public function logout(User $user): void
    {
        $user->tokens()->delete();
    }
}