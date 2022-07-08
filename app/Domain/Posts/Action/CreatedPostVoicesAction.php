<?php
namespace App\Domain\Posts\Action;
use App\Domain\Posts\Models\Voice;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class CreatedPostVoicesAction{
        
    public function execute($id,$data) 
    {
        $voice = new Voice;
        $unique = $voice->where('post_id',$id)->where('user_id',$data['user_id'])->exists();
        if(!$unique){
            $voice->post_id = $id;
            $voice->user_id = $data['user_id'];
            $voice->voices = $data['voices'];
            $voice->save();
            return $voice->fresh();
        }
        return $voice;
    }    
        
}