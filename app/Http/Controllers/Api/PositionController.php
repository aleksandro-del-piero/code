<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PositionCollection;
use App\Repositories\PositionRepository;
use Illuminate\Http\Request;

/**
 * Class PositionController
 * @package App\Http\Controllers\Api
 */
class PositionController extends Controller
{
    /**
     * @param PositionRepository $positionRepository
     * @param Request $request
     * @return PositionCollection|\Illuminate\Http\JsonResponse
     */
    public function __invoke(PositionRepository $positionRepository, Request $request)
    {
        $positions = $positionRepository->getListPositionForApi();

        if ($positions->isEmpty()) {
            return response()->json([
                'success' => 'false',
                'message' => 'Positions not found'
            ], 422);
        }
        return new PositionCollection($positions);
    }
}
