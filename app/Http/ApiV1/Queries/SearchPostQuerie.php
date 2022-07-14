<?php

namespace App\Http\ApiV1\Queries;

use App\Domain\Posts\Models\Post;
use App\Http\ApiV1\Requests\SearchPostParams;
use App\Http\ApiV1\Support\Pagination\PageBuilderFactory;
use App\Http\ApiV1\Support\Search\SearchPostPage;


use InvalidArgumentException;

class SearchPostQuerie
{

    public const INCLUDE_VOICES = 'voices';


    public function find(SearchPostParams $params): SearchPostPage
    {
        $query = Post::query()->where('id', '>', 0);
        //Перебор фильтров переданых в параметрах
        foreach ($params->getFilter() as $filter => $value) {
            switch ($filter) {
                case 'rating_gte':
                    $query->where('rating', '>=', $value);
                    break;
                case 'rating_lt':
                    $query->where('rating', '<=', $value);
                    break;
                case 'tags_like':
                    $query->where('tags', 'like', "%{$value}%");
                    break;
                case 'title_like':
                    $query->where('title', 'like', "%{$value}%");
                    break;
                case 'text_like':
                    $query->where('text', 'like', "%{$value}%");
                    break;
                case 'default':
                    break;
                default:
                    throw new InvalidArgumentException("{$filter} фильтр не найден");
            }
        }
        //Использование фильтров к запросу из переданого параметра
        foreach ($params->getSort() as $sort => $value) {
            switch ($value) {
                case 'id':
                    $query->orderBy('id', 'asc');
                    break;
                case '-id':
                    $query->orderBy('id', 'desc');
                    break;
                case 'created_at':
                    $query->orderBy('created_at', 'asc');
                    break;
                case '-created_at':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'updated_at':
                    $query->orderBy('updated_at', 'asc');
                    break;
                case '-updated_at':
                    $query->orderBy('updated_at', 'desc');
                    break;
                case 'rating':
                    $query->orderBy('rating', 'asc');
                    break;
                case '-rating':
                    $query->orderBy('rating', 'desc');
                    break;
                case 'default':
                    break;
                default:
                    throw new InvalidArgumentException("Не верное имя столбца в sort[{$sort}]");
            }
        }

        //Генерация пагинации 
        $pagination = (new PageBuilderFactory())->fromQuery($query->getQuery())->build()->pagination;
        //Всключение голосов пользователя 
        if ($params->isInclude(self::INCLUDE_VOICES) == true) {
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