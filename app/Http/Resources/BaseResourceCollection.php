<?php

namespace App\Http\Resources;

use App\Http\Resources\Source\PaginatedResourceModifiedResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class BaseResourceCollection
 * @package App\Http\Resources
 */
class BaseResourceCollection extends ResourceCollection
{
    /**
     * Create a paginate-aware HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function preparePaginatedResponse($request)
    {
        if ($this->preserveAllQueryParameters) {
            $this->resource->appends($request->query());
        } elseif (! is_null($this->queryParameters)) {
            $this->resource->appends($this->queryParameters);
        }

        return (new PaginatedResourceModifiedResponse($this))->toResponse($request);
    }
}
