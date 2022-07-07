<?php
namespace App\Http\ApiV1\Queries;
use App\Domain\Posts\Models\Post;
use Spatie\QueryBuilder\QueryBuilder;
class AllPostQueries{
        
    public  function query($page = 0)
    {
        $posts = QueryBuilder::for(Post::class);
        $offset = $page * 10;
        $limit = 10;
        $data = $posts->orderBy('id')->offset($offset)->limit($limit);
        return $data;
    }    
        
}