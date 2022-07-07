<?php
namespace App\Http\ApiV1\Queries;
use App\Domain\Posts\Models\Post;

class GetPostQueries{
        
    public function query(int $id) 
    {
        $post = Post::findOrFail($id);
        return $post;
    }    
        
}