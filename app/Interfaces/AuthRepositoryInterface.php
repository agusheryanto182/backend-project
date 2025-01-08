<?php

namespace App\Interfaces;

interface AuthRepositoryInterface
{
    public function getByUsername($username);
}
