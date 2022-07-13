<?php
namespace App\Domain\Posts\Action;
use App\Domain\Posts\Models\Voice;
use App\Domain\Posts\Action\UpdateTotalRatingAction;
class CreatedPostVoicesAction{
        
    public function execute($id,$data) : Voice
    {
        $voice = new Voice;
        $unique = $voice->where('post_id',$id)->where('user_id',$data['user_id'])->exists();
        if(!$unique){
            $voice->post_id = $id;
            $voice->user_id = $data['user_id'];
            $voice->voices = $data['voices'];
            $voice->save();
            (new UpdateTotalRatingAction)->execute($id);
            return $voice->fresh();
        }
        return $voice;
    }    
        
}