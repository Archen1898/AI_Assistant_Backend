<?php

namespace App;

interface CreateInterface
{
    public function create(array $request): object|null|array;
}
