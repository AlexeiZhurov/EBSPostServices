<?php
namespace App\Domain\Posts\Action;
use App\Domain\Posts\Models\Voice;
class PatchVoicePostAction{
        
    public function execute($post_id,$voice_id,$data) : Voice
    {
        $voice = Voice::where('post_id',$post_id)->where('id',$voice_id);
        if($data['voice']){
            $voice->voice = $data['voice'];
        }
        $voice->save();
        return $voice;
    }    
        
}