<?php

namespace App\Repositories\Contracts\EmployeePosition;

use App\Models\UserPosition;

interface EmployeePositionRepositoryInterface
{
    public function store(int $userID, int $positionID);
    public function getByUserID($id);
    public function getAll();
    public function delete(UserPosition $userPosition);

}
