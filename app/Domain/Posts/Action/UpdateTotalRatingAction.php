<?php

namespace App\Domain\Posts\Action;

use App\Domain\Posts\Models\Post;

class UpdateTotalRatingAction
{
    //Считает сумарный рейтинг поста 
    public function execute(int $postId): int
    {
        $post = Post::findOrFail($postId);
        $dis_voices = $post->voices()->where('voices', '-1')->count(); //Получает отрицательный голоса
        $pos_voices = $post->voices()->where('voices', '1')->count(); //Положительные
        $total_rating = $pos_voices - $dis_voices; //Получает разницу
        $post->rating = $total_rating; //Обновляте суммарный рейтинг

        $post->save();
        return $total_rating;
    }
}
