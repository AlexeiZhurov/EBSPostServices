<?php

namespace App\Domain\Posts\Action;

use App\Domain\Posts\Models\Voice;
use App\Domain\Posts\Action\UpdateTotalRatingAction;

class PatchVoicePostAction
{
    //Патчит голос поста в зависимости от переданых параметров
    public function execute($post_id, $voice_id, $data): Voice
    {
        $voice = Voice::where('post_id', $post_id)->where('id', $voice_id);
        if ($data['voice']) {
            $voice->voice = $data['voice'];
            (new UpdateTotalRatingAction())->execute($post_id); //Вызов экшена который обновить суммарный рейтинг поста
        }
        $voice->save();
        return $voice;
    }
}
