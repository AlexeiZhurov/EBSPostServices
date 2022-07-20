<?php

namespace App\Domain\Posts\Action;

use App\Domain\Posts\Models\Voice;
use App\Domain\Posts\Action\UpdateTotalRatingAction;

class PatchVoicePostAction
{
    //Патчит голос поста в зависимости от переданых параметров
    public function execute(int $postId, int $voiceId, array $data): Voice
    {
        $voice = Voice::where('post_id', $postId)->where('id', $voiceId)->first();
        if ($data['voices']) {
            $voice->voices = $data['voices'];
        }
        $voice->save();
        (new UpdateTotalRatingAction())->execute($postId); //Вызов экшена который обновить суммарный рейтинг поста
        return $voice;
    }
}