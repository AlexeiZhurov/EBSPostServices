<?php
namespace App\Http\ApiV1\Queries;
use App\Domain\Posts\Models\Post;
use Illuminate\Database\Query\Builder;
class AllPostQueries
{
        
    public  function query() : Builder
    {
        $posts = Post::orderBy('id','desc')->getQuery();
        return $posts;
    }    
        
}