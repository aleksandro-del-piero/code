<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class UserUniquePhoneValidationException extends Exception
{
    public function render(Request $request)
    {
        return response()->json([
            "success" => false,
            "message" => "User with this phone or email already exist"
        ], 409);
    }
}
