<?php

namespace App\Http\ApiV1\Queries;

use App\Domain\Posts\Models\Post;
use App\Http\ApiV1\Support\Pagination\PageBuilderFactory;
use App\Http\ApiV1\Support\Pagination\Page;

class AllPostQuerie
{
    //Возвращает страницу с items и pagination
    public  function get(): Page
    {
        $posts = Post::orderBy('id', 'desc')->getQuery();
        $page = (new PageBuilderFactory())->fromQuery($posts)->build();
        return $page;
    }
}
