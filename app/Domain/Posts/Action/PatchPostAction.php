<?php
namespace App\Domain\Posts\Action;
use App\Domain\Posts\Models\Post;
class PatchPostAction{
        
    public function execute($id,$data) : Post
    {
        $post = Post::find($id);
        if(isset($data['title'])){
            $post->title = $data['title'];
        }
        if(isset($data['preview'])){
            $post->preview = $data['preview'];
        }
        if(isset($data['tags'])){
            $post->tags = $data['tags'];
        }
        if(isset($data['text'])){
            $post->text = $data['text'];
        }
        $post->save();
        return $post;
    }    
        
}