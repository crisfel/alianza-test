<?php

namespace App\Http\Controllers\Employee;

use App\DTOs\Employee\UpdateEmployeeDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\UpdateRequest;
use App\Repositories\Contracts\Employee\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Hash;


class UpdateController extends Controller
{
    protected EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function __invoke(UpdateRequest $request)
    {
        try {
            $updateEmployeeDTO = new UpdateEmployeeDTO();
            $updateEmployeeDTO->id = intval($request->input('employeeID'));
            $updateEmployeeDTO->name = strval($request->input('name'));
            $updateEmployeeDTO->lastName = strval($request->input('lastName'));
            $updateEmployeeDTO->phone = strval($request->input('phone'));
            $updateEmployeeDTO->identification = strval($request->input('identification'));
            $updateEmployeeDTO->address = strval($request->input('address'));
            $updateEmployeeDTO->city = strval($request->input('city'));
            $updateEmployeeDTO->department = strval($request->input('department'));
            $updateEmployeeDTO->email = strval($request->input('email'));
            $updateEmployeeDTO->bossID = intval($request->input('bossID'));

            $employeeStoredMessage = $this->employeeRepository->update($updateEmployeeDTO);

            return response()->json($employeeStoredMessage);

        } catch(\Exception $e) {

            return response()->json([
                'status' => 500,
                'message' => 'ERROR: ' . $e->getMessage()
            ]);
        }
    }
}
