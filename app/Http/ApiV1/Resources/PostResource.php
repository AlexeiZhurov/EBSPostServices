<?php
namespace App\Http\ApiV1\Resources;
 
use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class PostResource extends BaseJsonResource
{
    
    public function toArray($data)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'preview' => $this->preview,
            'tags' => $this->tags,
            'text' => $this->text,
            'created_at' => $this->created_at,
        ];
    }
}