<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function update($request, $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return $user;
    }
}
