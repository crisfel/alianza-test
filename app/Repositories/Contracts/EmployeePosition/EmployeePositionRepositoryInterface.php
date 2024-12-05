<?php

namespace App\Repositories\Contracts\EmployeePosition;

interface EmployeePositionRepositoryInterface
{
    public function store(int $userID, int $positionID);


}
