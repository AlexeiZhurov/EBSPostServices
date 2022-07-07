<?php
namespace App\Domain\Posts\Action;
use App\Domain\Posts\Models\Post;

class DeletedPostAction{
        
    public function execute($id) : bool|null
    {
        $post = Post::find($id);
        if($post == null){
            return $post;
        }
        return $post->delete();
    }    
        
}