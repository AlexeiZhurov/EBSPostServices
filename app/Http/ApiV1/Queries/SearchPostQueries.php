<?php
namespace App\Http\ApiV1\Queries;

use App\Domain\Posts\Models\Post;
use App\Domain\Posts\Models\Voice;
use App\Http\ApiV1\Requests\SearchPostParams;
use App\Http\ApiV1\Support\Pagination\PageBuilderFactory;
use App\Http\ApiV1\Support\Search\PostDetail;
use App\Http\ApiV1\Support\Search\SearchPostPage;


use InvalidArgumentException;

class SearchPostQueries{
        
    public const INCLUDE_RATING = 'rating';
    public const INCLUDE_VOICES = 'voices';


    public function query(SearchPostParams $params) : SearchPostPage
    {
        $query = Post::query();
        // var_dump($params->getFilter());
        foreach ($params->getFilter() as $filter => $value){
            switch ($filter){
                case 'rating_gte':
                    $query->where('rating','>=',$value);
                    break;
                case 'rating_lt':
                    $query->where('rating','<=',$value);
                    break;
                case 'tags_like':
                    $query->where('tags','like',"%{$value}%");
                    break;
                case 'title_like':
                    $query->where('title','like',"%{$value}%");
                    break;
                case 'text_like':
                    $query->where('text','like',"%{$value}%");
                    break;
                default:
                    throw new InvalidArgumentException("{$filter} фильтр не найден");
            }
        }

        foreach ($params->getSort() as $sort => $value){
            switch ($value){
                case 'id':
                    $query->orderBy('id','asc');
                    break;
                case '-id':
                    $query->orderBy('id','desc');
                    break;
                case 'created_at':
                    $query->orderBy('created_at','asc');
                    break;
                case '-created_at':
                    $query->orderBy('created_at','desc');
                    break;
                case 'updated_at':
                    $query->orderBy('updated_at','asc');
                    break;
                case '-updated_at':
                    $query->orderBy('updated_at','desc');
                    break;
                case 'rating':
                    $query->orderBy('rating','asc');
                    break;
                case '-rating':
                    $query->orderBy('rating','desc');
                    break;
                default:
                    throw new InvalidArgumentException("Не верное имя столбца в sort[{$sort}]");
            }
        }

        //Генерация пагинации 
        $pagination = (new PageBuilderFactory())->fromQuery($query->getQuery())->build()->pagination;
        //Всключение голосов пользователя 
        if($params->isInclude(self::INCLUDE_VOICES)){
            $query->with('voice');
        }
        $posts = $query->get();
        //Возврощение объекта с постами и пагинации
        return new SearchPostPage(
            posts: $posts,
            pagination: $pagination
        );
    }    
        
}