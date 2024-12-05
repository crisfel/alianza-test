<?php

namespace App\Repositories\EmployeePosition;

use App\Models\UserPosition;
use App\Repositories\Contracts\EmployeePosition\EmployeePositionRepositoryInterface;
use Exception;

class EmployeePositionRepository implements EmployeePositionRepositoryInterface
{
    public function store(int $userID, int $positionID)
    {
        try {
            $userPosition = new UserPosition();
            $userPosition->user_id = $userID;
            $userPosition->position_id = $positionID;
            $userPosition->save();

            if ($userPosition) {
                return [
                    'status' => 200,
                    'message' => 'employee positions stored'
                ];
            }
        } catch(Exception $e) {
            return [
                'status' => 500,
                'message' => 'ERROR DE BASE DE DATOS: ' . $e->getMessage()
            ];
        }
    }


}
