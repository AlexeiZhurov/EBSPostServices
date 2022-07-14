<?php

namespace App\Http\ApiV1\Queries;

use App\Domain\Posts\Models\Voice;

class GetPostVoicesQuerie
{
    //Возврощает коллекцию голосов поста у которых post_id равен переданому id 
    public function get($post_id): Voice
    {
        $voices = Voice::where('post_id', $post_id)->get();
        return $voices;
    }
}
