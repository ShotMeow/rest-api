<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserSignupRequest;
use App\Models\User;
use App\Services\ResponseService;
use App\Services\UserTokenService;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        if (auth()->attempt($request->validated())) {
            $user = auth()->user();
            return ResponseService::success(['user_token' => UserTokenService::generate($user)]);
        }
        return ResponseService::error(401, 'Неправильные логин или пароль');
    }

    public function signup(UserSignupRequest $request)
    {
        $user = User::create($request->validated());
        return ResponseService::success(['user_token' => UserTokenService::generate($user)], 201);
    }

    public function logout()
    {
        auth()->user()->forceFill([
            'api_token' => null,
        ])->save();
        return ResponseService::success(['message' => 'Вы вышли из системы']);
    }
}
