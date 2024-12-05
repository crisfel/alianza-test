<?php

namespace App\Repositories\Position;

use App\Models\Position;
use App\Repositories\Contracts\Position\PositionRepositoryInterface;
use Exception;

class PositionRepository implements PositionRepositoryInterface
{
    public function getAll()
    {
        try {
            return Position::where('status', 1)->get();
        } catch(Exception $e) {
            return [
                'status' => 500,
                'message' => 'ERROR DE BASE DE DATOS: ' . $e->getMessage()
            ];
        }
    }

    public function store(string $name, ?string $responsibilities)
    {
        try{
            $position = new Position();
            $position->name = $name;
            $position->responsibilities = $responsibilities;
            $position->save();

            if ($position) {
                return [
                    'status' => 200,
                    'message' => 'position stored'
                ];
            }
        } catch(Exception $e) {
            return [
                'status' => 500,
                'message' => 'ERROR DE BASE DE DATOS: ' . $e->getMessage()
            ];
        }
    }

    public function update(int $id, string $name, ?string $responsibilities)
    {
        try {
            $position = $this->getByID($id);
            $position->name = $name;
            $position->responsibilities = $responsibilities;
            $position->save();

            if ($position) {
                return [
                    'status' => 200,
                    'message' => 'position updated'
                ];
            }

        } catch(Exception $e) {
            return [
                'status' => 500,
                'message' => 'ERROR DE BASE DE DATOS: ' . $e->getMessage()
            ];
        }
    }

    public function getByID(int $id)
    {
        try {
            return Position::find($id);
        } catch(Exception $e) {
            return [
                'status' => 500,
                'message' => 'ERROR DE BASE DE DATOS: ' . $e->getMessage()
            ];
        }
    }

    public function delete(int $id)
    {
        try {
            $position = $this->getByID($id);
            $position->status = 0;
            $position->save();

            if ($position) {
                return [
                    'status' => 200,
                    'message' => 'position deleted'
                ];
            }

        } catch(Exception $e) {
            return [
                'status' => 500,
                'message' => 'ERROR DE BASE DE DATOS: ' . $e->getMessage()
            ];
        }
    }
}
