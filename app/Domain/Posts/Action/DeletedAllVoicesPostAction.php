<?php

namespace App\Domain\Posts\Action;

use App\Domain\Posts\Models\Voice;
use App\Domain\Posts\Action\UpdateTotalRatingAction;

class DeletedAllVoicesPostAction
{
    //Удаляет все голоса по post_id
    public function execute(int $id): void
    {
        Voice::where('post_id', $id)->delete();
        (new UpdateTotalRatingAction())->execute($id); //Вызов экшена который обновить суммарный рейтинг поста

    }
}
