<?php

namespace App\UseCases\Contracts\Employee;

use App\DTOs\Employee\CreateEmployeeDTO;

interface StoreEmployeeUseCaseInterface
{
    public function handle(CreateEmployeeDTO $DTO);
}
