<?php


namespace App\Services;


use App\Contracts\StorageServiceInterface;
use App\DTO\UserRegisterDto;
use App\Events\RegisteredByApi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Class UserService
 * @package App\Services
 */
class UserService
{
    public $storage;

    public function __construct(StorageServiceInterface $storageService)
    {
        $this->storage = $storageService;
    }

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
                    'photo' => $this->storage->save($userRegisterDto->photo, 'photos')
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
