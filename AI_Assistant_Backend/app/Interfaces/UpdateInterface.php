<?php

namespace App;

interface UpdateInterface
{
    public function update(int $id, array $request): object|null|array;
}
