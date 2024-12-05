<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\Employee\EmployeeRepositoryInterface;
use App\Repositories\Contracts\EmployeePosition\EmployeePositionRepositoryInterface;
use App\Repositories\Contracts\Position\PositionRepositoryInterface;
use App\Repositories\Position\PositionRepository;
use Illuminate\Http\Request;

/**
 * @property $USER_ROLE_BOSS
 */
class HomeController extends Controller
{
    private const USER_ROLE_BOSS = 'Jefe';
    private const USER_ROLE_EMPLOYEE = 'Colaborador';

    protected EmployeeRepositoryInterface $employeeRepository;
    protected PositionRepositoryInterface $positionRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EmployeeRepositoryInterface $employeeRepository,
                                PositionRepositoryInterface $positionRepository)
    {
        $this->middleware('auth');
        $this->employeeRepository = $employeeRepository;
        $this->positionRepository = $positionRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bosses = $this->employeeRepository->getByRole(self::USER_ROLE_BOSS);
        $positions = $this->positionRepository->getAll();


        return view('home', ['bosses' => $bosses, 'positions' => $positions]);
    }
}
