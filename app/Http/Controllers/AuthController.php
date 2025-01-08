<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Interfaces\AuthRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\AuthResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{

    private AuthRepositoryInterface $authRepositoryInterface;
    public function __construct(AuthRepositoryInterface $authRepositoryInterface)
    {
        $this->authRepositoryInterface = $authRepositoryInterface;
    }

    public function login(LoginRequest $request)
    {
        try {
            Log::debug('Debugging login data', ['data' => $request->all()]);

            $validated = $request->validate([
                'username' => ['required', 'string', 'exists:users'],
                'password' => ['required', 'string', 'min:6'],
            ]);

            $user = $this->authRepositoryInterface->getByUsername($validated['username']);
            log::debug('User', ['user' => $user]);
            if (!$user || !Hash::check($validated['password'], $user->password)) {
                return ApiResponseClass::sendResponse('error', [], 'Invalid username or password.', 401);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return ApiResponseClass::sendResponseAuth('success', AuthResource::make($user), 'User successfully logged in.', 200, $token, 'admin');
        } catch (\Exception $e) {
            log::error($e);
            return ApiResponseClass::handleException($e);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return ApiResponseClass::sendResponse('success', [], 'User successfully logged out.', 200);
        } catch (\Exception $e) {
            Log::error($e);
            return ApiResponseClass::handleException($e);
        }
    }
}
