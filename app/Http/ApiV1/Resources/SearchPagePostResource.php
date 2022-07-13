<?php
namespace App\Http\ApiV1\Resources;
use App\Http\ApiV1\Resources\SearchPostResource;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;
 
class SearchPagePostResource extends BaseJsonResource
{
    
    public function toArray($request)
    {
        return [
            'data' => PostResource::collection($this->posts),
            'meta' => ['pagination' => $this->pagination]
        ];
    }
}