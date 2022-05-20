<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\BaseResource;
use Carbon\Carbon;

/**
 * Class UserResource
 * @package App\Http\Resources\Api
 */
class UserResource extends BaseResource
{
    /**
     * @var string
     */
    public static $wrap = 'user';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'position' => $this->whenLoaded('position', function () {
                return $this->position?->name;
            }),
            'position_id' => $this->position_id,
            'registration_timestamp' => Carbon::parse($this->created_at)->unix(),
            'photo' => asset($this->photo)
        ];
    }

    /**
     * @return array
     */
    public function addCustomParametersToResponse() : array
    {
        return [
            'success' => true
        ];
    }
}
