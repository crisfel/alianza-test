<?php

namespace App\Repositories\Contracts\Position;

interface PositionRepositoryInterface
{
    public function getAll();
    public function store(string $name, ?string $responsibilities);
    public function update(int $id, string $name, ?string $responsibilities);
    public function getByID(int $id);
    public function delete(int $id);

}
