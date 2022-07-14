<?php

namespace App\Domain\Posts\Action;

use App\Domain\Posts\Models\Voice;

class DeletedVoicePostAction
{

    public function execute($post_id,$voice_id): void
    {
        Voice::where('post_id',$post_id)->where('id',$voice_id)->delete();
    }
}
