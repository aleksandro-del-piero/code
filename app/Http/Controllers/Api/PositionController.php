<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\Custom\GeneralException;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\PositionCollection;
use App\Models\Position;
use Illuminate\Http\Request;

/**
 * Class PositionController
 * @package App\Http\Controllers\Api
 */
class PositionController extends Controller
{
    /**
     * @param Request $request
     * @return PositionCollection|\Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        return new PositionCollection(Position::get());
    }
}
