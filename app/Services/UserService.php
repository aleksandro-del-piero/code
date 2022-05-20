<?php


namespace App\Services;


use App\DTO\UserRegisterDto;
use App\Events\RegisteredByApi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserService
{
    /**
     * @param UserRegisterDto $userRegisterDto
     * @return mixed
     */
    public function registerByApi(UserRegisterDto $userRegisterDto): User
    {
        $user = User::create(
            array_merge(
                $userRegisterDto->all(),
                [
                    'password' => Hash::make(Str::random()),
                    'photo' => Storage::disk('public')->putFile('photos', $userRegisterDto->photo)
                ]
            )
        );

        event(new RegisteredByApi($userRegisterDto->token));

        return $user;
    }

    /**
     * @param $phone
     * @return bool
     */
    public function userWithPhoneExists($phone)
    {
        return User::query()
            ->where('phone', $phone)
            ->exists();
    }
}
