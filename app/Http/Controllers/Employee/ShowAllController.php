<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Employee\EmployeeRepositoryInterface;
use App\Repositories\Contracts\EmployeePosition\EmployeePositionRepositoryInterface;
use App\Repositories\Contracts\Position\PositionRepositoryInterface;
use Illuminate\Http\Request;

class ShowAllController extends Controller
{
    private const USER_ROLE_BOSS = 'Jefe';
    private const USER_ROLE_EMPLOYEE = 'Colaborador';


    protected EmployeeRepositoryInterface $employeeRepository;
    protected PositionRepositoryInterface $positionRepository;
    protected EmployeePositionRepositoryInterface $employeePositionRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository,
                                PositionRepositoryInterface $positionRepository,
                                EmployeePositionRepositoryInterface $employeePositionRepository)
    {
        $this->employeeRepository = $employeeRepository;
        $this->positionRepository = $positionRepository;
        $this->employeePositionRepository = $employeePositionRepository;
    }

    public function __invoke()
    {
        $employees = $this->employeeRepository->getAll();
        $bosses = $this->employeeRepository->getByRole(self::USER_ROLE_BOSS);
        $positions = $this->positionRepository->getAll();
        $employeesPositions = $this->employeePositionRepository->getAll();
        return view('employee.index', ['employees' => $employees, 'bosses' => $bosses, 'positions' => $positions, 'employeesPositions' => $employeesPositions]);

    }
}
