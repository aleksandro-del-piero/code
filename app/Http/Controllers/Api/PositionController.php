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
     * @return PositionCollection
     */
    public function __invoke(PositionRepository $positionRepository, Request $request)
    {
        return new PositionCollection($positionRepository->getListPositionForApi());
    }
}
