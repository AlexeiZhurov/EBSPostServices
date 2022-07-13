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

        foreach ($params->getSort() as $sort){
            switch ($sort){
                case 'id':
                    $query->orderBy('id','asc');
                    break;
                case '-id':
                    $query->orderBy('id','desc');
                    break;
                default:
                    throw new InvalidArgumentException("{$sort} не допустимы столбец для сортировки");
            }
        }

        foreach ($params->getFilter() as $filter => $value){
            switch ($filter){
                case 'rating_gte':
                    $query->where('rating','>=',$value);
                    break;
                default:
                    throw new InvalidArgumentException("{$filter} фильтр не найден");
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