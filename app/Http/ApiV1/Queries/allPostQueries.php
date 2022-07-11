<?php
namespace App\Http\ApiV1\Queries;
use App\Domain\Posts\Models\Post;
class AllPostQueries{
        
    public  function query()
    {
        $posts = Post::orderBy('created_at')->getQuery();
        return $posts;
    }    
        
}