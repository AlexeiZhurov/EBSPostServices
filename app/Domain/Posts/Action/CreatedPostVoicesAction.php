<?php
namespace App\Domain\Posts\Action;
use App\Domain\Posts\Models\Voice;
use App\Domain\Posts\Action\UpdateTotalRatingAction;
class CreatedPostVoicesAction{
        
    public function execute($id,$data) : Voice
    {
        $voice = new Voice;
        //Проверка того что пользователь еще не голосовал за данный пост
        $unique = $voice->where('post_id',$id)->where('user_id',$data['user_id'])->exists();
        if(!$unique){//Если не голосовал то создает пост
            $voice->post_id = $id;
            $voice->user_id = $data['user_id'];
            $voice->voices = $data['voices'];
            $voice->save();
            (new UpdateTotalRatingAction)->execute($id);//Вызов экшена который обновить суммарный рейтинг поста
            return $voice->fresh();
        }
        return $voice;//По умолчанию вернет пустую модель
    }    
        
}