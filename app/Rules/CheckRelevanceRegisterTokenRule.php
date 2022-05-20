<?php

namespace App\Rules;

use App\Exceptions\TokenExpiredException;
use App\Services\TokenService;
use Illuminate\Contracts\Validation\Rule;

class CheckRelevanceRegisterTokenRule implements Rule
{
    /** @var TokenService */
    protected $tokenService;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->tokenService = app()->make(TokenService::class);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!$this->tokenService->checkRelevance($value)) {
            throw new TokenExpiredException();
        };
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The token expired.';
    }
}
