<?php
namespace App\Domain\Posts\Action;

use App\Domain\Posts\Models\Post;

class CreatedPostAction{

    public function execute($data)
    {
        $post = new Post();
        $post->title = $data['title'];
        $post->preview = $data['preview'];
        $post->text = $data['text'];
        $post->tags = $data['tags'];
        $post->user_id = $data['user_id'];
        $post->save();
        $post = $post->fresh();
        return $post;
    }

}