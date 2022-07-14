<?php

namespace App\Http\ApiV1\Queries;

use App\Domain\Posts\Models\Post;
use App\Http\ApiV1\Requests\SearchPostParams;

class GetPostQuerie
{
    const INCLUDE_VOICES = 'voices';

    public function get(SearchPostParams $params, int $id) : Post
    {

        $query = Post::where('id', $id);
        if ($params->isInclude(self::INCLUDE_VOICES)) {
            $query->with('voice');
        }
        $post = $query->get()->first();
        return $post;
    }
}
