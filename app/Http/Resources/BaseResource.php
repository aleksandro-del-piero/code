<?php


namespace App\Http\Resources;

use App\Http\Resources\Source\ResourceModifiedResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        return (new ResourceModifiedResponse($this))->toResponse($request);
    }
}
