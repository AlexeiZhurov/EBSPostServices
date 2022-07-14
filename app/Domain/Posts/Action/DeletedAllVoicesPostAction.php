<?php

namespace App\Domain\Posts\Action;

use App\Domain\Posts\Models\Voice;

class DeletedAllVoicesPostAction
{
    //Удаляет все голоса по post_id
    public function execute($id): void
    {
        Voice::where('post_id', $id)->delete();
    }
}
