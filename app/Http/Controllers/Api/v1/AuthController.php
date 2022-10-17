<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**Регистрация пользователя
     * @param RegisterRequest $registerRequest
     *
     * @return JsonResponse
     */
    public function register(RegisterRequest $registerRequest): JsonResponse
    {
        $input = $registerRequest->validated();
        $input['password'] = bcrypt($input['password']);
        $user = User::query()->create($input);

        $token = $user->createToken($registerRequest->email)->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

    /**Логин пользователя
     * @param LoginRequest $loginRequest
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $loginRequest): JsonResponse
    {
        $user = User::query()->where('email', $loginRequest->email)->first();

        if (!$user || !Hash::check($loginRequest->password, $user->password)) {
            return response()->json(['error' => 'The provided credentials are incorrect.'], 401);
        }

        return response()->json([
            'status' => true,
            'message' => "Вы успешно вошли",
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => "Вы успешно вышли из учётной записи",
        ]);
    }
}
