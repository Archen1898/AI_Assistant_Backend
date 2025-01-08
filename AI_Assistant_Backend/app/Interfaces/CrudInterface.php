<?php

namespace App\Interfaces;

interface CrudInterface
{
    public function viewAll();
    public function viewById(int $id);
    public function create(array $request): object|null|array;
    public function update(int $id, array $request): object|null|array;
    public function delete(int $id): object|null;
}
