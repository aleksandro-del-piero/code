<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TokenService;
use Illuminate\Http\Request;

/**
 * Class TokenController
 * @package App\Http\Controllers\Api
 */
class TokenController extends Controller
{
    /**
     * @param TokenService $tokenService
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(TokenService $tokenService, Request $request)
    {
        try {
            return response()->json([
                'success' => true,
                'token' => $tokenService->create()
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Server error'
            ]);
        }
    }
}
