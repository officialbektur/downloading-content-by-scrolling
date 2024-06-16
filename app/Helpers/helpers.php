<?php

if (!function_exists('jsonResponsePagination')) {
    /**
     * @param $data
     * @param $resource
     * @param $paginationData
     * @return Illuminate\Http\Resources\Json\JsonResource
     */
    function jsonResponsePagination($data, $resource, $paginationData = null)
    {
        $response = [
            'data' => $resource::collection($data->items())->resolve(),
        ];

        if ($paginationData) {
            $response['pagination'] = [
                'current_page' => $paginationData->currentPage(),
                'first_page_url' => $paginationData->url(1),
                'from' => $paginationData->firstItem(),
                'last_page' => $paginationData->lastPage(),
                'last_page_url' => $paginationData->url($paginationData->lastPage()),
                'next_page_url' => $paginationData->nextPageUrl(),
                'path' => $paginationData->path(),
                'per_page' => $paginationData->perPage(),
                'prev_page_url' => $paginationData->previousPageUrl(),
                'to' => $paginationData->lastItem(),
                'total' => $paginationData->total(),
                'links' => $paginationData->linkCollection()->toArray(),
            ];
        }

        return response()->json($response);
    }
}