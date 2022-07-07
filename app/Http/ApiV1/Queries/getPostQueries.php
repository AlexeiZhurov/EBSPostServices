<?php
namespace App\Http\ApiV1\Queries;

use App\Domain\Posts\Models\Post;

class getPostQueries{
        
    public function query(int $id) : Post|null
    {
        $post = Post::find($id);
        return $post;
    }    
        
}