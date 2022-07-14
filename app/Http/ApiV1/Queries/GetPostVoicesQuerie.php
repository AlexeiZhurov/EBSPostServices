<?php
namespace App\Http\ApiV1\Queries;
use App\Domain\Posts\Models\Voice;
class GetPostVoicesQuerie
{
        
    public function get($post_id) : Voice
    {
        $voices = Voice::where('post_id',$post_id)->get();
        return $voices;
    }    
        
}