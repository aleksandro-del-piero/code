<?php

namespace App\Rules;

use App\Exceptions\UserUniquePhoneValidationException;
use App\Services\UserService;
use Illuminate\Contracts\Validation\Rule;

class UniqueUserPhoneRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        /** @var UserService $userService */
        $userService = app()->make(UserService::class);

        if ($userService->userWithPhoneExists($value)) {
            throw new UserUniquePhoneValidationException();
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
