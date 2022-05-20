<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\BaseResourceCollection;

/**
 * Class UserCollection
 * @package App\Http\Resources\Api
 */
class UserCollection extends BaseResourceCollection
{
    /**
     * @var UserResource
     */
    public $collects = UserResource::class;

    public static $wrap = 'users';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'users' => $this->collection,
        ];
    }

    /**
     * @return bool[]
     */
    public function addCustomParametersToResponse() : array
    {
        return [
            'success' => true,
        ];
    }
}
