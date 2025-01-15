<?php

namespace App\Interfaces;

interface UpdateInterface
{
    public function update(int $id, array $request): object|null|array;
}
