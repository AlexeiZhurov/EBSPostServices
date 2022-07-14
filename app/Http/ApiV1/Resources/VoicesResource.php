<?php

namespace App\Http\ApiV1\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VoicesResource extends JsonResource
{

    public function toArray($data): array
    {
        return [
            'id' => $this->id,
            'voices' => $this->voices,
            'user_id' => $this->user_id,
            'post_id' => $this->post_id,
            'created_at' => $this->created_at,
        ];
    }
}
