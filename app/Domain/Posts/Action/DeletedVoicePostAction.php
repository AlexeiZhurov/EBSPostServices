<?php

namespace App\Domain\Posts\Action;

use App\Domain\Posts\Models\Voice;

class DeletedVoicePostAction
{
    //Удаляет один определеный голос
    public function execute(int $post_id, int $voice_id): void
    {
        Voice::where('post_id', $post_id)->where('id', $voice_id)->delete();
    }
}
