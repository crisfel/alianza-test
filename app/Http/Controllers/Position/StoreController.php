<?php

namespace App\Http\Controllers\Position;

use App\Http\Controllers\Controller;
use App\Http\Requests\Position\CreateRequest;
use App\Repositories\Contracts\Position\PositionRepositoryInterface;
use Exception;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    protected PositionRepositoryInterface $positionRepository;

    public function __construct(PositionRepositoryInterface $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    public function __invoke(Request $request)
    {
        try{
            $name = strval($request->input('name'));
            $responsibilities = strval($request->input('responsibilities'));
            $positionStoredMessage = $this->positionRepository->store($name, $responsibilities);

            return response()->json($positionStoredMessage);

        } catch(Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'ERROR: ' . $e->getMessage()
            ]);
        }


    }
}
