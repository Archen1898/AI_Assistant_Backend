<?php

namespace App\Interfaces;

interface CreateInterface
{
    public function create(array $request): object|null|array;
}
