<?php

namespace App\Interfaces;

interface DivisionRepositoryInterface
{
    public function index($search = null, $perpage = null);
}
