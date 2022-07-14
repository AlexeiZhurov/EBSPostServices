<?php

namespace App\Http\ApiV1\Queries;

use App\Domain\Posts\Models\Post;
use App\Http\ApiV1\Requests\SearchPostParams;

class GetPostQueries
{
    const INCLUDE_VOICES = 'voices';

    public function query(SearchPostParams $params, int $id)
    {

        $query = Post::where('id', $id);
        if ($params->isInclude(self::INCLUDE_VOICES)) {
            $query->with('voice');
        }
        $post = $query->get()->first();
        return $post;
    }
}
