<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\BaseResourceCollection;

class PositionCollection extends BaseResourceCollection
{
    public static $wrap = 'positions';

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'success' => 'true',
            'positions' => $this->collection,
        ];
    }
}
