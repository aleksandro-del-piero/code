<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterToken extends Model
{
    use HasFactory;

    const USED = 1;
    const NOT_USED = 0;

    protected $fillable = [
        'name',
        'token',
        'lifetime',
        'is_used'
    ];
}
