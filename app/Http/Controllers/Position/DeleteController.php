<?php

namespace App\Http\Controllers\Position;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Employee\EmployeeRepositoryInterface;
use App\Repositories\Contracts\Position\PositionRepositoryInterface;
use App\Repositories\Position\PositionRepository;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    protected PositionRepositoryInterface $positionRepository;

    public function __construct(PositionRepositoryInterface $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    public function __invoke(int $positionID)
    {
        try {
            $positionDeletedMessage = $this->positionRepository->delete($positionID);
            return response()->json($positionDeletedMessage);
        } catch(\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'ERROR: ' . $e->getMessage()
            ]);
        }
    }
}
