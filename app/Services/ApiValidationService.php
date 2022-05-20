<?php


namespace App\Services;


use App\Exceptions\TokenExpiredException;

class ApiValidationService
{
    /** @var TokenService $tokenService */
    protected $tokenService;

    public function __construct()
    {
        $this->tokenService = app()->make(TokenService::class);
    }

    /**
     * @param $token
     * @return bool
     * @throws TokenExpiredException
     */
    public function checkRelevanceHeaderApiToken($token) : bool
    {
        if (!$this->tokenService->checkRelevance($token)) {
            throw new TokenExpiredException();
        }
        return true;
    }
}
