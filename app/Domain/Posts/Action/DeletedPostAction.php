<?php

namespace App\Domain\Posts\Action;

use App\Domain\Posts\Models\Post;
use App\Domain\Posts\Action\UpdateTotalRatingAction;

class DeletedPostAction
{
    //Удаляет пост
    public function execute($id): bool|null
    {
        $post = Post::findOrFail($id)->delete();
        (new UpdateTotalRatingAction())->execute($id); //Вызов экшена который обновить суммарный рейтинг поста
        return $post;
    }
}
