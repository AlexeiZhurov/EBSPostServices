<?php

namespace App\Http\ApiV1\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class PostResource extends BaseJsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'preview' => $this->preview,
            'tags' => $this->tags,
            'text' => $this->text,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'rating'  => $this->rating,

        ];
    }
}
