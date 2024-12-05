<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Employee\EmployeeRepositoryInterface;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    protected EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function __invoke(int $employeeID)
    {
        return $this->employeeRepository->delete($employeeID);
    }
}
