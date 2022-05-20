<?php


namespace App\ViewModels;


use App\Http\Resources\UserResource;
use Illuminate\Contracts\Support\Arrayable;


class UsersListViewForm implements Arrayable
{
    public $users;

    /**
     * UsersListViewForm constructor.
     * @param $users
     */
    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'users' => $this->users
        ];
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getJsonUsers()
    {
        return UserResource::collection($this->users);
    }
}
