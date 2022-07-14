<?php
namespace App\Http\ApiV1\Queries;
use App\Domain\Posts\Models\Post;
use Illuminate\Database\Query\Builder;
class AllPostQuerie
{
    //Возвращает Builder который,нужен для создания пагинации с использованием  PageBuilderFactory
    public  function get() : Builder
    {
        $posts = Post::orderBy('id','desc')->getQuery();
        return $posts;
    }    
        
}