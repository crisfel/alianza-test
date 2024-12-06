<?php

namespace App\Http\Controllers\Employee;

use App\DTOs\Employee\UpdateEmployeeDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\UpdateRequest;
use App\Repositories\Contracts\Employee\EmployeeRepositoryInterface;
use App\UseCases\Contracts\Employee\UpdateEmployeeUseCaseInterface;
use Illuminate\Support\Facades\Hash;


class UpdateController extends Controller
{
    protected UpdateEmployeeUseCaseInterface $updateEmployeeUseCase;

    public function __construct(UpdateEmployeeUseCaseInterface $updateEmployeeUseCase)
    {
        $this->updateEmployeeUseCase = $updateEmployeeUseCase;
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
            $updateEmployeeDTO->role = strval($request->input('role'));
            $updateEmployeeDTO->city = strval($request->input('city'));
            $updateEmployeeDTO->department = strval($request->input('department'));
            $updateEmployeeDTO->email = strval($request->input('email'));
            $updateEmployeeDTO->position = array_map([$this, 'parseInt'], (array) $request->positionIDs);;

            if (isset($request->bossID)) {
                $updateEmployeeDTO->bossID = intval($request->input('bossID'));
            }

            if (isset($request->password)) {
                $updateEmployeeDTO->password = strval($request->input('password'));
            }

            $employeeUpdatedMessage = $this->updateEmployeeUseCase->handle($updateEmployeeDTO);

            return response()->json($employeeUpdatedMessage);

        } catch(\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'ERROR: ' . $e->getMessage()
            ]);
        }
    }

    public function parseInt(string $id)
    {
        return intval($id);
    }
}
