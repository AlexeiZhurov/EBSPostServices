<?php
namespace App\Http\ApiV1\Queries;
use App\Domain\Posts\Models\Post;
use App\Http\ApiV1\Support\Pagination\Page;

class allPostQueries{
        
    public  function query($page = 0)
    {
        $posts = (New Post);
        $offset = $page * 10;
        $limit = 10;
        $total = $posts->count(); 
        $data = $posts->orderBy('id')->offset($offset)->limit($limit)->get();
        $paginate=[
                'offset'=> $offset,
                'limit' => $limit,
                'total' => $total,
                'type'  => 'offset'  
        ];
        return new Page($data,$paginate);
    }    
        
}