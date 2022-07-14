<?php

namespace App\Http\ApiV1\Resources;

use App\Http\ApiV1\Resources\PostAndVoicesResource;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class SearchPagePostResource extends BaseJsonResource
{

    public function toArray($request)
    {
        return [
            'data' => PostAndVoicesResource::collection($this->posts),
            'meta' => ['pagination' => $this->pagination]
        ];
    }
}
