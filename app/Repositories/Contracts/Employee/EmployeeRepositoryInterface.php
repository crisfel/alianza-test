<?php

namespace App\Repositories\Contracts\Employee;

use App\DTOs\Employee\CreateEmployeeDTO;
use App\DTOs\Employee\UpdateEmployeeDTO;

interface EmployeeRepositoryInterface
{
    public function store(CreateEmployeeDTO $DTO);
    public function update(UpdateEmployeeDTO $DTO);
    public function delete(int $id);
    public function getByID(int $id);
    public function getAll();
    public function getByRole(string $role);
    public function getByEmail(string $email);
}
