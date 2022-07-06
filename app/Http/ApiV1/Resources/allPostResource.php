<?php
namespace App\Http\ApiV1\Resources;
 
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\ApiV1\Support\Resources\BaseJsonResource;
 
class allPostResource extends BaseJsonResource
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