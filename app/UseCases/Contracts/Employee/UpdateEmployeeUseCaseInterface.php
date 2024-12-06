<?php

namespace App\UseCases\Contracts\Employee;

use App\DTOs\Employee\UpdateEmployeeDTO;

interface UpdateEmployeeUseCaseInterface
{
    public function handle(UpdateEmployeeDTO $DTO);
}
