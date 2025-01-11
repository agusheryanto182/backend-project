<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    private UserRepositoryInterface $userRepositoryInterface;
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->userRepositoryInterface = $userRepositoryInterface;
    }

    public function update(UpdateUserRequest $request)
    {
        try {
            Log::debug('Request Data: ', $request->all());

            $user = auth()->user();

            log::debug('user', ['user' => $user]);

            $this->userRepositoryInterface->update($request, $user->id);

            return ApiResponseClass::sendResponse('success', [], 'User successfully updated.', 200, 'user');
        } catch (\Exception $e) {
            return ApiResponseClass::handleException($e);
        }
    }
}
