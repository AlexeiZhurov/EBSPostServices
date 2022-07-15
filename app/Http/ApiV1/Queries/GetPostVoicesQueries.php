<?php
namespace App\Http\ApiV1\Queries;
use App\Domain\Posts\Models\Voice;
class GetPostVoicesQueries
{
        
    public function query($post_id) 
    {
        $voices = Voice::where('post_id',$post_id)->get();
        return $voices;
    }    
        
}