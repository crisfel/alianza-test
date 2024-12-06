<?php

namespace App\Repositories\Employee;

use App\DTOs\Employee\CreateEmployeeDTO;
use App\DTOs\Employee\UpdateEmployeeDTO;
use App\Models\User;
use App\Repositories\Contracts\Employee\EmployeeRepositoryInterface;
use Exception;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function store(CreateEmployeeDTO $DTO)
    {
        try {
            $employee = $this->getByEmail($DTO->email);

            if (! empty($employee)) {
                return [
                    'status' => 400,
                    'message' => 'Duplicated email'
                ];
            }

            $employee = new User();
            $employee->name = $DTO->name;
            $employee->last_name = $DTO->lastName;
            $employee->phone = $DTO->phone;
            $employee->identification = $DTO->identification;
            $employee->address = $DTO->address;
            $employee->city = $DTO->city;
            $employee->department = $DTO->department;
            $employee->email = $DTO->email;
            $employee->password = $DTO->password;
            $employee->role = $DTO->role;

        if ($DTO->bossID =! 0) {
            $employee->boss_id = $DTO->bossID;
        }

        $employeeStored = $employee->save();

        if ($employeeStored) {
            return [
                'status' => 200,
                'message' => 'employee stored'
            ];

        }

        } catch( Exception $e) {
            return [
                'status' => 500,
                'message' => 'ERROR DE BASE DE DATOS: ' . $e->getMessage()
            ];
        }
    }

    public function update(UpdateEmployeeDTO $DTO)
    {
        try {
            $employee = $this->getByID($DTO->id);

            if (! empty($DTO->name)) {
                $employee->name = $DTO->name;
            }

            if (! empty($DTO->lastName)) {
                $employee->last_name = $DTO->lastName;
            }

            if (! empty($DTO->phone)) {
                $employee->phone = $DTO->phone;
            }

            if (! empty($DTO->identification)) {
                $employee->identification = $DTO->identification;
            }

            if (! empty($DTO->address)) {
                $employee->address = $DTO->address;
            }

            if (! empty($DTO->city)) {
                $employee->city = $DTO->city;
            }

            if (! empty($DTO->department)) {
                $employee->department = $DTO->department;
            }

            if ($DTO->bossID =! 0) {
                $employee->boss_id = $DTO->bossID;
            }

            if (isset($DTO->password)) {
                $employee->password = $DTO->password;
            }

            $employeeUpdated = $employee->save();

            if ($employeeUpdated) {
                return [
                    'status' => 200,
                    'message' => 'employee updated'
                ];
            }
        } catch(Exception $e) {
            return [
                'status' => 500,
                'message' => 'ERROR DE BASE DE DATOS: ' . $e->getMessage()
            ];
        }
    }

    public function delete(int $id)
    {
        try {
            $employee = $this->getByID($id);
            $employee->status = 0;
            $employee->save();

            return [
                'status' => 200,
                'message' => 'employee deleted'
            ];

        } catch(Exception $e) {
            return [
                'status' => 500,
                'message' => 'ERROR DE BASE DE DATOS: ' . $e->getMessage()
            ];
        }
    }

    public function getByID(int $id)
    {
        try {
            return User::find($id);
        } catch(Exception $e) {
            return [
                'status' => 500,
                'message' => 'ERROR DE BASE DE DATOS: ' . $e->getMessage()
            ];
        }
    }

    public function getAll()
    {
        try {
            return User::where('status', 1)->orderBy('created_at','Desc')->get();
        } catch(Exception $e) {
            return [
                'status' => 500,
                'message' => 'ERROR DE BASE DE DATOS: ' . $e->getMessage()
            ];
        }
    }

    public function getByRole(string $role)
    {
        try {
            return User::where('role', $role)->get();
        } catch(Exception $e) {
            return [
                'status' => 500,
                'message' => 'ERROR DE BASE DE DATOS: ' . $e->getMessage()
            ];
        }
    }

    public function getByEmail(string $email)
    {
        try{
            return User::where('email', $email)->first();
        } catch(Exception $e) {
            return [
                'status' => 500,
                'message' => 'ERROR DE BASE DE DATOS: ' . $e->getMessage()
            ];
        }
    }
}
