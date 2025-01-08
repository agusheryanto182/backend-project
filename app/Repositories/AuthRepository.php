<?php

namespace App\Repositories;

use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;

class AuthRepository implements AuthRepositoryInterface
{
    public function getByUsername($username)
    {
        return User::where('username', $username)->first();
    }
}
