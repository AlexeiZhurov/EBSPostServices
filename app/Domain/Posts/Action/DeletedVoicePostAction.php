<?php

namespace App\Domain\Posts\Action;

use App\Domain\Posts\Models\Voice;

class DeletedVoicePostAction
{
    //Удаляет один определеный голос
    public function execute(int $postId, int $voiceId): void
    {
        Voice::where('post_id', $postId)->where('id', $voiceId)->firstOrFail()->delete();
    }
}
