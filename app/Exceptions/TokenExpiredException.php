<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class TokenExpiredException extends Exception
{
    public function render(Request $request)
    {
        return response()->json([
            "success" => false,
            "message" => "The token expired."
        ], 401);
    }
}
