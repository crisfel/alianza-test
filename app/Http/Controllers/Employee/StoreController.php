<?php

namespace App\Http\Controllers\Employee;

use App\DTOs\Employee\CreateEmployeeDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\CreateRequest;
use App\Repositories\Contracts\Employee\EmployeeRepositoryInterface;
use App\UseCases\Contracts\Employee\StoreEmployeeUseCaseInterface;
use Illuminate\Support\Facades\Hash;


class StoreController extends Controller
{
    protected StoreEmployeeUseCaseInterface $storeEmployeeUseCase;

    public function __construct(StoreEmployeeUseCaseInterface $storeEmployeeUseCase)
    {
        $this->storeEmployeeUseCase = $storeEmployeeUseCase;
    }

    public function __invoke(CreateRequest $request)
    {
        try {
            $createEmployeeDTO = new CreateEmployeeDTO();
            $createEmployeeDTO->name = strval($request->input('name'));
            $createEmployeeDTO->lastName = strval($request->input('lastName'));
            $createEmployeeDTO->phone = strval($request->input('phone'));
            $createEmployeeDTO->identification = strval($request->input('identification'));
            $createEmployeeDTO->address = strval($request->input('address'));
            $createEmployeeDTO->city = strval($request->input('city'));
            $createEmployeeDTO->department = strval($request->input('department'));
            $createEmployeeDTO->email = strval($request->input('email'));
            $createEmployeeDTO->password = Hash::make(strval($request->input('password')));
            $createEmployeeDTO->role = strval($request->input('role'));

            if (isset($request->bossID)) {
                $createEmployeeDTO->bossID = intval($request->input('bossID'));
            }
            $createEmployeeDTO->position =  array_map([$this, 'parseInt'], (array) $request->positionIDs);;
            $employeeStoredMessage = $this->storeEmployeeUseCase->handle($createEmployeeDTO);

        return response()->json($employeeStoredMessage);

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
