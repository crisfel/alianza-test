<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Employee\EmployeeRepositoryInterface;
use App\Repositories\Contracts\Position\PositionRepositoryInterface;
use Illuminate\Http\Request;

class ShowAllController extends Controller
{
    private const USER_ROLE_BOSS = 'Jefe';
    private const USER_ROLE_EMPLOYEE = 'Colaborador';


    protected EmployeeRepositoryInterface $employeeRepository;
    protected PositionRepositoryInterface $positionRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository,
                                PositionRepositoryInterface $positionRepository)
    {
        $this->employeeRepository = $employeeRepository;
        $this->positionRepository = $positionRepository;
    }

    public function __invoke()
    {
        $employees = $this->employeeRepository->getAll();
        $bosses = $this->employeeRepository->getByRole(self::USER_ROLE_BOSS);
        $positions = $this->positionRepository->getAll();

        return view('employee.index', ['employees' => $employees, 'bosses' => $bosses, 'positions' => $positions]);

    }
}
