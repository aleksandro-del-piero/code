<?php


namespace App\Http\Resources\Source;

use Illuminate\Http\Resources\Json\ResourceResponse;
use Illuminate\Support\Collection;

/**
 * Class ResourceModifiedResponse
 * @package App\Http\Resources\Source
 */
class ResourceModifiedResponse extends ResourceResponse
{
    /**
     * Wrap the given data if necessary.
     *
     * @param  array  $data
     * @param  array  $with
     * @param  array  $additional
     * @return array
     */
    protected function wrap($data, $with = [], $additional = [])
    {
        if ($data instanceof Collection) {
            $data = $data->all();
        }

        if ($this->haveDefaultWrapperAndDataIsUnwrapped($data)) {
            $data = [$this->wrapper() => $data];
        } elseif ($this->haveAdditionalInformationAndDataIsUnwrapped($data, $with, $additional)) {
            $data = [($this->wrapper() ?? 'data') => $data];
        }

        if (method_exists($this->resource, 'addCustomParametersToResponse')) {
            $data = array_merge_recursive($this->resource->addCustomParametersToResponse(), $data);
        }

        return array_merge_recursive($data, $with, $additional);
    }
}
