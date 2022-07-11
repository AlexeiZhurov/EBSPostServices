<?php
namespace App\Http\ApiV1\Queries;
use App\Domain\Posts\Models\Post;

class GetPostQueries{
        
    public function query(int $id) 
    {
        $post = Post::where('id', $id)->get();
        return $post;
    }    
        
}