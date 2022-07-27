<?php

namespace App\Domain\Posts\Action;

use App\Domain\Posts\Models\Voice;
use App\Domain\Posts\Action\UpdateTotalRatingAction;

class DeletedVoicePostAction
{
    //Удаляет один определеный голос
    public function execute(int $postId, int $voiceId): void
    {
        Voice::findOrFail($voiceId)->delete();
        (new UpdateTotalRatingAction())->execute($postId); //Вызов экшена который обновить суммарный рейтинг поста
    }
}
