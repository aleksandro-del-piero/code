<?php


namespace App\Http\Resources\Source;

use Illuminate\Http\Resources\Json\PaginatedResourceResponse;
use Illuminate\Support\Arr;

class PaginatedResourceModifiedResponse extends PaginatedResourceResponse
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toResponse($request)
    {
        return tap(response()->json(
            $this->wrap(
                array_merge_recursive(
                    $this->meta($this->resource->resource->toArray()),
                    $this->paginationInformation($request),
                    $this->resource->with($request),
                    $this->resource->additional,
                    $this->resource->resolve($request),
                )
            ),
            $this->calculateStatus(),
            [],
            $this->resource->jsonOptions()
        ), function ($response) use ($request) {
            $response->original = $this->resource->resource->map(function ($item) {
                return is_array($item) ? Arr::get($item, 'resource') : $item->resource;
            });

            $this->resource->withResponse($request, $response);
        });
    }

    /**
     * Add the pagination information to the response.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function paginationInformation($request)
    {
        $paginated = $this->resource->resource->toArray();

        $default = [
            'links' => $this->paginationLinks($paginated),
        ];

        if (method_exists($this->resource, 'paginationInformation')) {
            return $this->resource->paginationInformation($request, $paginated, $default);
        }

        return $default;
    }

    /**
     * Get the pagination links for the response.
     *
     * @param array $paginated
     * @return array
     */
    protected function paginationLinks($paginated)
    {
        return [
            'next_url' => $paginated['next_page_url'] ?? null,
            'prev_url' => $paginated['prev_page_url'] ?? null,
        ];
    }

    /**
     * Gather the meta data for the response.
     *
     * @param array $paginated
     * @return array
     */
    protected function meta($paginated)
    {
        $metaPaginated = Arr::except($paginated, [
            'data',
            'first_page_url',
            'last_page_url',
            'prev_page_url',
            'next_page_url',
            'links'
        ]);

        $data = [
            'page' => $metaPaginated['current_page'],
            'total_pages' => $metaPaginated['last_page'],
            'total_users' => $metaPaginated['total'],
            'count' => $metaPaginated['per_page'],
        ];

        if (method_exists($this->resource, 'addCustomParametersToResponse')) {
            $data = array_merge_recursive($this->resource->addCustomParametersToResponse(), $data);
        }

        return $data;
    }
}
