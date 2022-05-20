<?php


namespace App\DTO;

use Spatie\DataTransferObject\DataTransferObject;

/**
 * Class UserRegisterDto
 * @package App\DTO
 */
class UserRegisterDto extends DataTransferObject
{
    public string $name;

    public $email;

    public $phone;

    public int $position_id;

    public $photo;

    public $token;
}
