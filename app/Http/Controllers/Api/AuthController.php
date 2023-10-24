<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        if (!auth()->attempt($request->validated())) {
            return response()->json([
                'message' => 'Неверный логин или пароль'
            ], 422);
        }

        /** @var User $user */
        $user = auth()->user();
        return response()->json([
            'token' => $user->createToken('tokens')->plainTextToken,
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        return auth()->user()->tokens()
            ->where('id', Str::before($request->bearerToken(), '|'))
            ->delete();
    }
}
