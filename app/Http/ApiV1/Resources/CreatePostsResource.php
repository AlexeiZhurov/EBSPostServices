<?php
namespace App\Http\ApiV1\Resources;
 
use Illuminate\Http\Resources\Json\ResourceCollection;
 
class CreatePostsResource extends ResourceCollection
{
    
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}