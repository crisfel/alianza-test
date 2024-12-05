<?php

namespace App\UseCases\Employee;

use App\DTOs\Employee\CreateEmployeeDTO;
use App\Repositories\Contracts\Employee\EmployeeRepositoryInterface;
use App\Repositories\Contracts\EmployeePosition\EmployeePositionRepositoryInterface;
use App\Repositories\EmployeePosition\EmployeePositionRepository;
use App\UseCases\Contracts\Employee\StoreEmployeeUseCaseInterface;

class StoreEmployeeUseCase implements StoreEmployeeUseCaseInterface
{
    protected EmployeePositionRepositoryInterface $employeePositionRepository;
    protected EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeePositionRepositoryInterface $employeePositionRepository,
                                EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeePositionRepository = $employeePositionRepository;
        $this->employeeRepository = $employeeRepository;
    }

    public function handle(CreateEmployeeDTO $DTO)
    {

        try {
            $employeeStoredMessage = $this->employeeRepository->store($DTO);
            $employee = $this->employeeRepository->getByEmail($DTO->email);

            if ($employeeStoredMessage['status'] == 200) {
                foreach ($DTO->position as $position) {
                    $this->employeePositionRepository->store($employee->id, $position);
                }

                return $employeeStoredMessage;

            }
        } catch(Exception $e) {
            return [
                'status' => 500,
                'message' => 'ERROR DE BASE DE DATOS: ' . $e->getMessage()
            ];
        }



    }
}
