<?php

namespace App\UseCases\Employee;

use App\DTOs\Employee\UpdateEmployeeDTO;
use App\Repositories\Contracts\Employee\EmployeeRepositoryInterface;
use App\Repositories\Contracts\EmployeePosition\EmployeePositionRepositoryInterface;
use App\UseCases\Contracts\Employee\UpdateEmployeeUseCaseInterface;

class UpdateEmployeeUseCase implements UpdateEmployeeUseCaseInterface
{
    protected EmployeePositionRepositoryInterface $employeePositionRepository;
    protected EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeePositionRepositoryInterface $employeePositionRepository,
                                EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeePositionRepository = $employeePositionRepository;
        $this->employeeRepository = $employeeRepository;
    }

    public function handle(UpdateEmployeeDTO $DTO)
    {
        try {
            $employeeUpdatedMessage = $this->employeeRepository->update($DTO);
            $employee = $this->employeeRepository->getByID($DTO->id);

            $employeePositions = $this->employeePositionRepository->getByUserID($employee->id);

            foreach ($employeePositions as $employeePosition) {
                $this->employeePositionRepository->delete($employeePosition);
            }

            if ($employeeUpdatedMessage['status'] == 200) {
                foreach ($DTO->position as $position) {
                    $this->employeePositionRepository->store($employee->id, $position);
                }

                return $employeeUpdatedMessage;
            }
        } catch(Exception $e) {
            return [
                'status' => 500,
                'message' => 'ERROR DE BASE DE DATOS: ' . $e->getMessage()
            ];
        }
    }
}
