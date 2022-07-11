<?php
namespace App\Http\ApiV1\Resources;
 
use App\Http\ApiV1\Support\Resources\BaseJsonResource;
use App\Http\ApiV1\Resources\VoicesResource;
class PostAndVoicesResource extends BaseJsonResource
{
    
    public function toArray($request)
    {   
        //Если значени input не равно [] то $include равен переданым значениям иначе он равен пустому массиву , что in_array не ругалась
        $request->input('include') != [] ? $incude = $request->input('include') : $incude = [];

        return [
            'id' => $this->id,
            'title' => $this->title,
            'preview' => $this->preview,
            'tags' => $this->tags,
            'text' => $this->text,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            $this->mergeWhen(in_array('voices',$incude), [
                'voices' => $this->voices_pos[0]->count - $this->voices_dis[0]->count
            ]),
            
        ];
    }
}