<?php

namespace App\Http\Controllers\Position;

use App\Http\Controllers\Controller;
use App\Http\Requests\Position\UpdateRequest;
use App\Repositories\Contracts\Position\PositionRepositoryInterface;
use Exception;

class UpdateController extends Controller
{
    protected PositionRepositoryInterface $positionRepository;

    public function __construct(PositionRepositoryInterface $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    public function __invoke(UpdateRequest $request)
    {
        try {
            $positionID = intval($request->input('id'));
            $name = strval($request->input('name'));
            $responsibilities = strval($request->input('responsibilities'));

            $positionUpdatedMessage = $this->positionRepository->update($positionID, $name, $responsibilities);
            return response()->json($positionUpdatedMessage);

        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'ERROR: ' . $e->getMessage()
            ]);
        }
    }
}
