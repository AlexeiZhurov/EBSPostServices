<?php

namespace App\Http\ApiV1\Action;
use App\Model\Posts;
class CreatePostsAction{

    public function execute($data)
    {
        $post = new Posts();
        $post->title = $data['title'];
        $post->preview = $data['preview'];
        $post->text = $data['text'];
        $post->tags = $data['tags'];
        $post->user_id = $data['user_id'];
        $post->save();
        return $post;
    }

} 